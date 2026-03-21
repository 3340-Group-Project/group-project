<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    // NOTE: index() handles this route/action.
    public function index(Request $request)
    {
                // Admin book list: q=search, status=all/active/sold.
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
            ->withQueryString(); // NOTE: keeps current filters in pagination links.

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

    // NOTE: toggleSold() handles this route/action.
    public function toggleSold(Book $book)
    {
        $book->is_sold = !$book->is_sold;
        $book->save();

        return back()->with('status', 'Listing updated.');
    }

    // NOTE: destroy() handles this route/action.
    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('status', 'Listing deleted.');
    }
}