@extends('wiki.layout')

@section('title', 'Wiki — Browse Listings')

@section('page')
<section class="wiki-header">
    <h1>🔍 Browse Listings</h1>
    <p>How to find the books and resources you need quickly using search, filters and sorting.</p>
</section>

<section class="wiki-content-section">
    <h2>Searching</h2>
    <div class="wiki-card">
        <h3>Keyword search</h3>
        <p>Use the search bar on the Book Listings page to search by title, author, ISBN, or course code. Short, specific terms usually return the best results (e.g. "MATH101 calculator").</p>
    </div>

    <h2>Filters</h2>
    <div class="wiki-card">
        <h3>Available filters</h3>
        <p>Use the filters to narrow results by format (Paperback, Hardcover, eBook), condition, course code, and price range. Combine filters for precise results.</p>
    </div>

    <div class="wiki-card">
        <h3>Clear filters</h3>
        <p>Click "Clear Filters" to reset all filters and return to the full listing set.</p>
    </div>

    <h2>Sorting</h2>
    <div class="wiki-card">
        <h3>Sort options</h3>
        <p>Sort by newest, price (low → high), or price (high → low) where available. Use sort + filters to find the best match for your budget and needs.</p>
    </div>

    <h2>Viewing a listing</h2>
    <div class="wiki-card">
        <h3>Detail view</h3>
        <p>Click a listing to open the detail page which includes photos, description, seller contact options, and item metadata (ISBN, condition, format).</p>
    </div>

    <h2>Reporting problems</h2>
    <div class="wiki-card">
        <h3>Inappropriate or incorrect listings</h3>
        <p>If you see a listing that violates site rules or is clearly incorrect, contact the site administrators or use any available "Report" action. Admins can remove or edit listings via the admin portal.</p>
    </div>
</section>
@endsection

