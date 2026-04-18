<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardKatalog extends Model
{
    protected $table      = 'reward_katalog';
    protected $primaryKey = 'id_reward_katalog';
    public    $timestamps = false;

    protected $fillable = [
        'id_mitra',
        'nama_reward',
        'harga_poin',
        'deskripsi_reward',
        'foto_reward',
    ];

    // Relasi: mitra yang menyediakan reward ini
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id_mitra');
    }

    // Relasi: redeem yang menggunakan reward ini
    public function redeems()
    {
        return $this->hasMany(Redeem::class, 'id_reward_katalog', 'id_reward_katalog');
    }
}
