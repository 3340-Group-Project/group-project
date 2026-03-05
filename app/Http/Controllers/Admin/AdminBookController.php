<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', 'all'); // all|active|sold

        $books = Book::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('course_code', 'like', "%{$q}%")
                      ->orWhere('author', 'like', "%{$q}%")
                      ->orWhere('isbn', 'like', "%{$q}%");
            })
            ->when($status === 'active', fn($query) => $query->where('is_sold', false))
            ->when($status === 'sold', fn($query) => $query->where('is_sold', true))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.books.index', compact('books'));
    }

    public function toggleSold(Book $book)
    {
        $book->is_sold = !$book->is_sold;
        $book->save();

        return back()->with('status', 'Listing updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('status', 'Listing deleted.');
    }
}
