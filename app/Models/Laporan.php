<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama', 'kategoris_id', 'nilai'];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori', 'kategoris_id', 'id');
    }
}
