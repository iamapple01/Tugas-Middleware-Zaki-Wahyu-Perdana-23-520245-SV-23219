<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id',
        'review',
        'review_date',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'review_tag');
    }
}
