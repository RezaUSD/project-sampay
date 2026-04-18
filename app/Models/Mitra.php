<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table      = 'mitras';
    protected $primaryKey = 'id_mitra';
    public    $timestamps = false;

    protected $fillable = [
        'nama_mitra',
        'foto_logo_mitra',
        'kontribusi_dana',
    ];

    // Relasi: reward yang disponsori mitra ini
    public function rewardKatalog()
    {
        return $this->hasMany(RewardKatalog::class, 'id_mitra', 'id_mitra');
    }
}
