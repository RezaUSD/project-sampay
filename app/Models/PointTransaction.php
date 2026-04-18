<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    protected $table      = 'point_transactions';
    protected $primaryKey = 'id_transaksi';
    public    $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_laporan',
        'id_redeem',
        'tipe_transaksi',
        'jumlah_poin',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'datetime',
        ];
    }

    // Relasi: user pemilik transaksi
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi: laporan yang memicu transaksi (jika ada)
    public function laporan()
    {
        return $this->belongsTo(Report::class, 'id_laporan', 'id_laporan');
    }

    // Relasi: redeem yang memicu transaksi (jika ada)
    public function redeem()
    {
        return $this->belongsTo(Redeem::class, 'id_redeem', 'id_redeem');
    }

    // Scope: pemasukan saja
    public function scopePemasukan($query)
    {
        return $query->where('tipe_transaksi', 'Pemasukan');
    }

    // Scope: pengeluaran saja
    public function scopePengeluaran($query)
    {
        return $query->where('tipe_transaksi', 'Pengeluaran');
    }
}
