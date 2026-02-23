@php
$val = fn($k, $default='') => old($k, $book?->{$k} ?? $default);
@endphp

<label>Title</label>
<input name="title" value="{{ $val('title') }}" required>

<label>Course Code</label>
<input name="course_code" value="{{ $val('course_code') }}" placeholder="e.g. COMP 3340" required>

<label>Author</label>
<input name="author" value="{{ $val('author') }}">

<label>ISBN</label>
<input name="isbn" value="{{ $val('isbn') }}">

<label>Condition</label>
<select name="condition" required>
    @foreach(['New','Like New','Good','Fair','Poor'] as $c)
        <option value="{{ $c }}" @selected($val('condition','Good')===$c)>{{ $c }}</option>
    @endforeach
</select>

<label>Format</label>
<select name="format" required>
    @foreach(['Paperback','Hardcover','Loose-leaf','eBook'] as $f)
        <option value="{{ $f }}" @selected($val('format','Paperback')===$f)>{{ $f }}</option>
    @endforeach
</select>

<label>Price (CAD)</label>
<input type="number" name="price" value="{{ old('price', $book ? ($book->price_cents/100) : '') }}" step="0.01" min="0.0" required>

<label>Description</label>
<textarea name="description" placeholder="Write additional info about posting here" rows="5">{{ $val('description') }}</textarea>

<label>Cover Image</label>
@if($book?->cover_image_path)
    <div>
        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Current cover image" style="max-width: 180px; height: auto; display: block; margin-bottom: 0.5rem;">
    </div>
@endif
<input type="file" name="cover_image" accept="image/*" @required(!$book)>
