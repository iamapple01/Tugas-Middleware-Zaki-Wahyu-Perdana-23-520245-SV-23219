<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\BelongsTo;

class gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['id', 'nama_galeri','path','buku_id'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
