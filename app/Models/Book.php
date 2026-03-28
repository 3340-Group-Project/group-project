<?php

// NOTE: Model defines DB fields (fillable), casts, and relationships.


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

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

    public function getCoverImageUrlAttribute() {
        if (!$this->cover_image_path) {
            // Return placeholder if no image
            $placeholderNumber = (crc32($this->id ?? rand()) % 6) + 1;
            return asset('images/book' . $placeholderNumber . '.webp');
        }
        
        // Check if it's already a full URL
        if (filter_var($this->cover_image_path, FILTER_VALIDATE_URL)) {
            return $this->cover_image_path;
        }
        
        // Use the configured disk (will use S3/R2 in production)
        return Storage::url($this->cover_image_path);
    }
}