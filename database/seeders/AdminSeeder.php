<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mitra;
use App\Models\RewardKatalog;
use App\Models\Report;
use App\Models\PointTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================
        // 1. Buat akun Admin Pusat
        // =====================================
        $admin = User::updateOrCreate(
            ['email' => 'admin@sampay.id'],
            [
                'nama_lengkap'     => 'Admin SAMPAY',
                'password'         => Hash::make('sampay123'),
                'role'             => 'Admin Pusat',
                'saldo_poin'       => 0,
                'tanggal_registrasi' => now(),
            ]
        );

        // =====================================
        // 2. Buat beberapa akun Petugas
        // =====================================
        $petugasList = [
            ['nama_lengkap' => 'Ahmad Fauzi',    'email' => 'petugas1@sampay.id'],
            ['nama_lengkap' => 'Siti Rahmah',     'email' => 'petugas2@sampay.id'],
            ['nama_lengkap' => 'Budi Santoso',   'email' => 'petugas3@sampay.id'],
        ];

        foreach ($petugasList as $p) {
            User::updateOrCreate(
                ['email' => $p['email']],
                [
                    'nama_lengkap'       => $p['nama_lengkap'],
                    'password'           => Hash::make('sampay123'),
                    'role'               => 'Petugas',
                    'saldo_poin'         => 0,
                    'tanggal_registrasi' => now(),
                ]
            );
        }

        // =====================================
        // 3. Buat beberapa akun Warga
        // =====================================
        $wargaList = [
            ['nama_lengkap' => 'Budi Warga',      'email' => 'warga1@sampay.id', 'poin' => 150],
            ['nama_lengkap' => 'Siti Aminah',     'email' => 'warga2@sampay.id', 'poin' => 80],
            ['nama_lengkap' => 'Hendra Pratama',  'email' => 'warga3@sampay.id', 'poin' => 320],
            ['nama_lengkap' => 'Dewi Lestari',    'email' => 'warga4@sampay.id', 'poin' => 60],
            ['nama_lengkap' => 'Rizky Maulana',   'email' => 'warga5@sampay.id', 'poin' => 200],
        ];

        foreach ($wargaList as $w) {
            User::updateOrCreate(
                ['email' => $w['email']],
                [
                    'nama_lengkap'       => $w['nama_lengkap'],
                    'password'           => Hash::make('sampay123'),
                    'role'               => 'Warga',
                    'saldo_poin'         => $w['poin'],
                    'tanggal_registrasi' => now()->subDays(rand(1, 60)),
                ]
            );
        }

        // =====================================
        // 4. Buat Mitra CSR
        // =====================================
        $mitraA = Mitra::updateOrCreate(
            ['nama_mitra' => 'PT. Banua Hijau'],
            ['kontribusi_dana' => 5000000]
        );
        $mitraB = Mitra::updateOrCreate(
            ['nama_mitra' => 'CV. Martapura Bersih'],
            ['kontribusi_dana' => 2500000]
        );

        // =====================================
        // 5. Buat Reward (Katalog Menarik)
        // =====================================
        // Hapus hadiah lama yang tidak diinginkan
        RewardKatalog::whereIn('nama_reward', ['Kupon Makan Hemat', 'Tumbler Ramah Lingkungan', 'Tumbler Eksklusif SAMPAY', 'Kupon Makan Rp 25.000'])->delete();

        $rewards = [
            [
                'nama' => 'Pulsa All Operator Rp 10.000',
                'poin' => 50,
                'desk' => 'Isi ulang pulsa senilai Rp 10.000 untuk semua operator seluler.',
                'foto' => 'images/catalog/pulsa.png'
            ],
            [
                'nama' => 'Saldo DANA / OVO Rp 25.000',
                'poin' => 120,
                'desk' => 'Top-up saldo dompet digital DANA atau OVO senilai Rp 25.000.',
                'foto' => 'images/catalog/dana ovo.png'
            ],
            [
                'nama' => 'Beras Premium 1kg',
                'poin' => 150,
                'desk' => 'Beras kualitas premium kemasan 1kg dari mitra Martapura Bersih.',
                'foto' => 'images/catalog/beras.png'
            ],
            [
                'nama' => 'Minyak Goreng 1 Liter',
                'poin' => 180,
                'desk' => 'Minyak goreng kelapa sawit jernih kemasan pouch 1 liter.',
                'foto' => 'images/catalog/minyak.png'
            ],
            [
                'nama' => 'Voucher Belanja Rp 50.000',
                'poin' => 250,
                'desk' => 'Voucher belanja fisik yang dapat ditukarkan di minimarket mitra.',
                'foto' => 'images/catalog/belanja.png'
            ],
            [
                'nama' => 'Tumbler Ramah Lingkungan',
                'poin' => 200,
                'desk' => 'Botol minum reusable ramah lingkungan untuk kurangi sampah plastik.',
                'foto' => 'images/catalog/tumbler.png'
            ],
            [
                'nama' => 'Kupon Makan Hemat',
                'poin' => 45,
                'desk' => 'Voucher makan di warung mitra binaan SAMPAY.',
                'foto' => 'images/catalog/makan.png'
            ],
        ];

        foreach ($rewards as $r) {
            RewardKatalog::updateOrCreate(
                ['nama_reward' => $r['nama']],
                [
                    'id_mitra'        => (rand(0, 1) == 0) ? $mitraA->id_mitra : $mitraB->id_mitra,
                    'harga_poin'      => $r['poin'],
                    'deskripsi_reward'=> $r['desk'],
                    'foto_reward'     => $r['foto'],
                ]
            );
        }

        // =====================================
        // 6. Buat Laporan Dummy
        // =====================================
        $petugas = User::where('role', 'Petugas')->get();
        $warga   = User::where('role', 'Warga')->get();

        // Koordinat sekitar Banjarmasin
        $koordinat = [
            [-3.3194, 114.5908],
            [-3.3250, 114.5820],
            [-3.3120, 114.5950],
            [-3.3300, 114.6020],
            [-3.3080, 114.5780],
            [-3.3350, 114.5900],
            [-3.3200, 114.6100],
        ];

        $kategori = ['Organik', 'Anorganik', 'Sampah Sungai'];
        $statusSet = [
            ['Pending',  null],
            ['Diproses', 0],
            ['Selesai',  1],
            ['Ditolak',  null],
        ];

        foreach ($warga as $w) {
            for ($i = 0; $i < rand(2, 4); $i++) {
                $coord  = $koordinat[array_rand($koordinat)];
                $status = $statusSet[array_rand($statusSet)];
                $kat    = $kategori[array_rand($kategori)];

                $laporan = Report::create([
                    'id_user'        => $w->id_user,
                    'id_petugas'     => $status[1] !== null ? $petugas[$status[1] % $petugas->count()]->id_user : null,
                    'latitude'       => $coord[0] + (rand(-50, 50) / 10000),
                    'longitude'      => $coord[1] + (rand(-50, 50) / 10000),
                    'kategori'       => $kat,
                    'status'         => $status[0],
                    'keterangan_warga' => 'Tumpukan sampah ' . $kat . ' di lokasi ini perlu segera ditangani.',
                    'foto_sampah_masuk' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=400&auto=format&fit=crop', // Gambar dumpy sampah
                    'tanggal_lapor'  => now()->subDays(rand(0, 30)),
                ]);

                // Jika selesai, beri poin
                if ($status[0] === 'Selesai') {
                    $poin = rand(10, 50);
                    PointTransaction::create([
                        'id_user'          => $w->id_user,
                        'id_laporan'       => $laporan->id_laporan,
                        'tipe_transaksi'   => 'Pemasukan',
                        'jumlah_poin'      => $poin,
                        'keterangan'       => "Poin dari laporan #{$laporan->id_laporan} ({$kat})",
                        'tanggal_transaksi'=> now()->subDays(rand(0, 15)),
                    ]);
                }
            }
        }

        $this->command->info('✅ Seeding selesai!');
        $this->command->info('📧 Login Admin: admin@sampay.id');
        $this->command->info('🔑 Password: sampay123');
    }
}
