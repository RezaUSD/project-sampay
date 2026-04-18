<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table      = 'redeems';
    protected $primaryKey = 'id_redeem';
    public    $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_reward_katalog',
        'jumlah_poin',
        'status_redeem',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_redeem' => 'datetime',
        ];
    }

    // Relasi: user yang melakukan redeem
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi: reward yang ditukar
    public function rewardKatalog()
    {
        return $this->belongsTo(RewardKatalog::class, 'id_reward_katalog', 'id_reward_katalog');
    }

    // Relasi: transaksi poin terkait redeem ini
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class, 'id_redeem', 'id_redeem');
    }

    // Scope: redeem pending
    public function scopePending($query)
    {
        return $query->where('status_redeem', 'Pending');
    }
}
