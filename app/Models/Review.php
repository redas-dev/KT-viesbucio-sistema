<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'review_date',
        'rating',
        'comments'
    ];

    protected $casts = [
        'review_date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }
}
