<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany relation
use Intervention\Image\Facades\Image;
use App\Models\Gallery; // Import the Gallery model

class Buku extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit'];

    protected $dates = ['tgl_terbit'];

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
