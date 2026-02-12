<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::query()->latest()->paginate(20);
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
