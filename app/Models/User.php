<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'foto_profil',
        'saldo_poin',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'          => 'hashed',
            'tanggal_registrasi'=> 'datetime',
        ];
    }

    // Relasi: laporan yang dibuat warga ini
    public function laporan()
    {
        return $this->hasMany(Report::class, 'id_user', 'id_user');
    }

    // Relasi: laporan yang ditangani petugas ini
    public function tugasLaporan()
    {
        return $this->hasMany(Report::class, 'id_petugas', 'id_user');
    }

    // Relasi: redeem yang dilakukan user ini
    public function redeems()
    {
        return $this->hasMany(Redeem::class, 'id_user', 'id_user');
    }

    // Relasi: transaksi poin
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class, 'id_user', 'id_user');
    }

    // Helper: cek role
    public function isAdmin(): bool
    {
        return $this->role === 'Admin Pusat';
    }

    public function isPetugas(): bool
    {
        return $this->role === 'Petugas';
    }

    public function isWarga(): bool
    {
        return $this->role === 'Warga';
    }
}

