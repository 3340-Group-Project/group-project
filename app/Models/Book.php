<?php

// NOTE: Model defines DB fields (fillable), casts, and relationships.


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'course_code',
        'author',
        'isbn',
        'condition',
        'format',
        'price_cents',
        'description',
        'cover_image_path',
        'is_sold',
    ];

    protected $casts = [
        'is_sold' => 'boolean',
        'price_cents' => 'integer',
    ];

    // NOTE: user() handles this route/action.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // NOTE: getPriceDollarsAttribute() handles this route/action.
    public function getPriceDollarsAttribute(): string
    {
        return number_format($this->price_cents / 100, 2, '.', '');
    }
}