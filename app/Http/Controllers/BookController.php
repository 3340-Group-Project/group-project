<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // NOTE: index() handles this route/action.
    public function index(Request $request)
    {
        // 1. Initialize the query (only show active listings by default)
        $q = Book::query()->where('is_sold', false);

        // 2. Global Search (Title, Course, Author, ISBN)
        if ($search = $request->string('q')->toString()) {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // 3. Specific Course Filter
        if ($course = $request->string('course')->toString()) {
            $q->where('course_code', 'like', "%{$course}%");
        }

        // 4. Format/Filter Logic (Handles both 'format' and 'filter' params)
                // Accept format or filter (different front-end names).
$format = trim((string) ($request->query('format') ?? $request->query('filter') ?? ''));
        if ($format !== '') {
            $q->where('format', $format);
        }

        // 5. Condition Filter
        if ($cond = $request->string('condition')->toString()) {
            $q->where('condition', $cond);
        }

        // 6. Price Filtering (Converted to cents for DB comparison)
        $minRaw = $request->query('min_price');
        if ($minRaw !== null && $minRaw !== '') {
            $q->where('price_cents', '>=', (int)$minRaw * 100);
        }

        $maxRaw = $request->query('max_price');
        if ($maxRaw !== null && $maxRaw !== '') {
            $q->where('price_cents', '<=', (int)$maxRaw * 100);
        }

        // 7. Execute Pagination
        $books = $q->latest()->simplePaginate(12)->withQueryString(); // NOTE: keeps current filters in pagination links.

        return view('books.index', compact('books'));
    }

    // NOTE: show() handles this route/action.
    public function show(Book $book)
    {
        $book->load('user');
        return view('books.show', compact('book'));
    }

    // NOTE: myListings() handles this route/action.
    public function myListings()
    {
        $books = Auth::user()->books()->latest()->paginate(12);
        return view('books.my', compact('books'));
    }

    // NOTE: create() handles this route/action.
    public function create()
    {
        return view('books.create');
    }

    // NOTE: store() handles this route/action.
    public function store(Request $request)
    {
        $data = $this->validateBook($request);

        $book = new Book($data);
        $book->user_id = Auth::id();

        if ($request->hasFile('cover_image')) {
            $book->cover_image_path = $request->file('cover_image')->store('book_covers', 'public');
        }

        $book->save();

        return redirect()->route('books.my')->with('status', 'Listing created!');
    }

    // NOTE: edit() handles this route/action.
    public function edit(Book $book)
    {
        $this->authorizeOwner($book);
        return view('books.edit', compact('book'));
    }

    // NOTE: update() handles this route/action.
    public function update(Request $request, Book $book)
    {
        $this->authorizeOwner($book);

        $data = $this->validateBook($request, $book->id);
        $book->fill($data);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }
            $book->cover_image_path = $request->file('cover_image')->store('book_covers', 'public');
        }

        $book->save();

        return redirect()->route('books.my')->with('status', 'Listing updated!');
    }

    // NOTE: markSold() handles this route/action.
    public function markSold(Book $book)
    {
        $this->authorizeOwner($book);
        $book->is_sold = true;
        $book->save();

        return back()->with('status', 'Marked as sold.');
    }

    // NOTE: destroy() handles this route/action.
    public function destroy(Book $book)
    {
        $this->authorizeOwner($book);

        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()->route('books.my')->with('status', 'Listing deleted.');
    }

    // NOTE: validateBook() handles this route/action.
    private function validateBook(Request $request, ?int $bookId = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'author' => ['nullable', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:50'],
            'condition' => ['required', Rule::in(['New', 'Like New', 'Good', 'Fair', 'Poor'])],
            'format' => ['required', Rule::in(['Paperback', 'Hardcover', 'Loose-leaf', 'eBook'])],
            'price' => ['required', 'numeric', 'min:0.0', 'max:10000'],
            'description' => ['nullable', 'string', 'max:5000'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['price_cents'] = (int) round(((float) $data['price']) * 100);
        unset($data['price']);

        return $data;
    }

    // NOTE: authorizeOwner() handles this route/action.
    private function authorizeOwner(Book $book): void
    {
        if ($book->user_id !== Auth::id() && !Auth::user()?->is_admin) {
            abort(403); // NOTE: forbidden (not allowed).
        }
    }
}