<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama', 'kategoris_id', 'deskripsi', 'jumlah', 'stok', 'rusak'];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategoris_id', 'id');
    }
}
