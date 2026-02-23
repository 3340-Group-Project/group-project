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
        $q = Book::query()->where('is_sold', false);

        if ($search = $request->string('q')->toString()) {
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

        if ($min = $request->integer('min_price')) {
            $q->where('price_cents', '>=', $min * 100);
        }
        if ($max = $request->integer('max_price')) {
            $q->where('price_cents', '<=', $max * 100);
        }

        if ($cond = $request->string('condition')->toString()) {
            $q->where('condition', $cond);
        }

        if ($format = $request->string('format')->toString()) {
            $q->where('format', $format);
        }

        $books = $q->latest()->paginate(12)->withQueryString();

        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load('user');
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
            'price' => ['required', 'numeric', 'min:0.0', 'max:10000'],
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
