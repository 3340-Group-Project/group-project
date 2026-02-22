<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', '')); // active | sold | all

        $booksQ = Book::query();

        if ($status === 'active') {
            $booksQ->where('is_sold', false);
        } elseif ($status === 'sold') {
            $booksQ->where('is_sold', true);
        }

        if ($search !== '') {
            $like = '%' . $search . '%';
            $booksQ->where(function ($w) use ($like) {
                $w->where('title', 'like', $like)
                    ->orWhere('course_code', 'like', $like)
                    ->orWhere('author', 'like', $like)
                    ->orWhere('isbn', 'like', $like);
            });
        }

        $books = $booksQ->latest()->paginate(20)->withQueryString();

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
