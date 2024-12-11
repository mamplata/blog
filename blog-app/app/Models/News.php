<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //

    protected $primaryKey = "id";

    protected $fillable = [
        'headline',
        'content',
        'author',
        'date_published',
        'user_id',
    ];

    protected $casts = [
        'date_published' => 'datetime', // Casts the field to a Carbon instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDatePublishedFormattedAttribute()
    {
        return Carbon::parse($this->date_published)->format('F j, Y'); // Example: December 9, 2024
    }
}
