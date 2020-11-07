<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentTeam extends Model
{
    use HasFactory;
    protected $table = "current_team";
    protected $fillable = ['id', 'nama'];

    public function phone()
    {
        return $this->hasOne('App\Models\Phone', 'current_team_id', 'id');
    }
}
