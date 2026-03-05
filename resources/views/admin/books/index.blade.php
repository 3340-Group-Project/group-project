@extends('layouts.app')

@section('content')
<div style="max-width: 1100px; margin: 0 auto; padding: 16px;">
  <h1>Admin - Book Listings</h1>

  @if(session('status'))
    <div style="background:#e9fff0;border:1px solid #bde5c8;padding:10px;border-radius:8px;margin:12px 0;">
      {{ session('status') }}
    </div>
  @endif

  <form method="GET" action="{{ route('admin.books.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin:12px 0;">
    <input name="q" value="{{ request('q') }}" placeholder="Search title/course/ISBN..." style="padding:10px;border-radius:10px;border:1px solid #ccc;min-width:240px;">
    <select name="status" style="padding:10px;border-radius:10px;border:1px solid #ccc;">
      @php($st = request('status','all'))
      <option value="all" {{ $st==='all'?'selected':'' }}>All</option>
      <option value="active" {{ $st==='active'?'selected':'' }}>Active only</option>
      <option value="sold" {{ $st==='sold'?'selected':'' }}>Sold only</option>
    </select>
    <button type="submit" style="padding:10px 14px;border-radius:10px;border:0;background:#0b5f84;color:#fff;cursor:pointer;">Apply</button>
  </form>

  <table style="width:100%;border-collapse:collapse;background:#fff;border-radius:10px;overflow:hidden;">
    <thead>
      <tr style="background:#f3f7fb;">
        <th style="padding:10px;text-align:left;">Title</th>
        <th style="padding:10px;text-align:left;">Course</th>
        <th style="padding:10px;text-align:left;">Price</th>
        <th style="padding:10px;text-align:left;">Status</th>
        <th style="padding:10px;text-align:left;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($books as $book)
        <tr>
          <td style="padding:10px;border-top:1px solid #e7eef4;">
            <a href="{{ route('books.show', $book) }}" target="_blank">{{ $book->title }}</a>
            <div style="font-size:12px;color:#456;">ISBN: {{ $book->isbn ?? '-' }}</div>
          </td>
          <td style="padding:10px;border-top:1px solid #e7eef4;">{{ $book->course_code ?? '-' }}</td>
          <td style="padding:10px;border-top:1px solid #e7eef4;">${{ number_format($book->price_cents / 100, 2) }}</td>
          <td style="padding:10px;border-top:1px solid #e7eef4;">{{ $book->is_sold ? 'SOLD' : 'ACTIVE' }}</td>
          <td style="padding:10px;border-top:1px solid #e7eef4;display:flex;gap:8px;flex-wrap:wrap;">
            <form method="POST" action="{{ route('admin.books.toggleSold', $book) }}">
              @csrf
              <button type="submit" style="padding:8px 10px;border-radius:10px;border:0;background:#0b5f84;color:#fff;cursor:pointer;">
                {{ $book->is_sold ? 'Mark Active' : 'Mark Sold' }}
              </button>
            </form>

            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Delete this listing?');">
              @csrf
              @method('DELETE')
              <button type="submit" style="padding:8px 10px;border-radius:10px;border:0;background:#b0192a;color:#fff;cursor:pointer;">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div style="margin-top: 12px;">
    {{ $books->links() }}
  </div>
</div>
@endsection
