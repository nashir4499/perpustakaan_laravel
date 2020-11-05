<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "peminjamans";
    protected $fillable = ['id', 'bukus_id', 'members_id', 'waktu_pengembalian', 'ket_pengembalian', 'created_at'];

    public function buku()
    {
        return $this->belongsTo('App\Models\Buku', 'bukus_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'members_id', 'id');
    }
}
