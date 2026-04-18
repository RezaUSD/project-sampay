<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table      = 'reports';
    protected $primaryKey = 'id_laporan';
    public    $timestamps = false;

    protected $fillable = [
        'id_user',
        'foto_sampah_masuk',
        'foto_sampah_selesai',
        'latitude',
        'longitude',
        'kategori',
        'keterangan_warga',
        'status',
        'id_petugas',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lapor' => 'datetime',
            'latitude'      => 'double',
            'longitude'     => 'double',
        ];
    }

    // Relasi: user yang melaporkan
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi: petugas yang ditugaskan
    public function petugas()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id_user');
    }

    // Relasi: transaksi poin terkait laporan ini
    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class, 'id_laporan', 'id_laporan');
    }

    // Scope: laporan pending
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    // Scope: laporan selesai
    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }
}
