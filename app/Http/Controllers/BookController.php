<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Public catalogue (only show active listings by default)
        $q = Book::query()->where('is_sold', false);

        // Support both parameter names:
        // - "q" is the canonical name used by backend
        // - "search_bar" is used by the styled UI that was merged
        $search = trim((string) ($request->query('q', '') ?: $request->query('search_bar', '')));
        if ($search !== '') {
            $q->where(function ($w) use ($search) {
                $w->where('title', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($course = $request->string('course')->toString()) {
            $q->where('course_code', 'like', "%{$course}%");
        }

        // Note: integer() returns 0 for "0" which is falsy, so use explicit checks
        $minRaw = $request->query('min_price');
        if ($minRaw !== null && $minRaw !== '') {
            $min = (int) $minRaw;
            $q->where('price_cents', '>=', $min * 100);
        }
        $maxRaw = $request->query('max_price');
        if ($maxRaw !== null && $maxRaw !== '') {
            $max = (int) $maxRaw;
            $q->where('price_cents', '<=', $max * 100);
        }

        if ($cond = $request->string('condition')->toString()) {
            $q->where('condition', $cond);
        }

        // Support both parameter names:
        // - "format" is canonical
        // - "filter" was used by the styled UI select
        $format = trim((string) ($request->query('format', '') ?: $request->query('filter', '')));
        if ($format !== '') {
            $q->where('format', $format);
        }

        $books = $q->latest()->paginate(12)->withQueryString();

        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function myListings()
    {
        $books = Auth::user()->books()->latest()->paginate(12);
        return view('books.my', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

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

    public function edit(Book $book)
    {
        $this->authorizeOwner($book);
        return view('books.edit', compact('book'));
    }

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

    public function markSold(Book $book)
    {
        $this->authorizeOwner($book);
        $book->is_sold = true;
        $book->save();

        return back()->with('status', 'Marked as sold.');
    }

    public function destroy(Book $book)
    {
        $this->authorizeOwner($book);

        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()->route('books.my')->with('status', 'Listing deleted.');
    }

    private function validateBook(Request $request, ?int $bookId = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'author' => ['nullable', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:50'],
            'condition' => ['required', Rule::in(['New', 'Like New', 'Good', 'Fair', 'Poor'])],
            'format' => ['required', Rule::in(['Paperback', 'Hardcover', 'Loose-leaf', 'eBook'])],
            'price' => ['required', 'numeric', 'min:0.01', 'max:10000'],
            'description' => ['nullable', 'string', 'max:5000'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['price_cents'] = (int) round(((float) $data['price']) * 100);
        unset($data['price']);

        return $data;
    }

    private function authorizeOwner(Book $book): void
    {
        if ($book->user_id !== Auth::id() && !Auth::user()?->is_admin) {
            abort(403);
        }
    }
}
