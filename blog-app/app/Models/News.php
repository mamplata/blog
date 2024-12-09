<?php

namespace App\Models;

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
}
