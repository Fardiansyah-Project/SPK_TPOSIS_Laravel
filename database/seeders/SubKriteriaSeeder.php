<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subKriteriaData = [
            // C1 Penghasilan
            ['kriteria_kode' => 'C1', 'kode' => 'C1.1', 'nama' => 'Kurang dari Rp 500.000', 'nilai' => 1],
            ['kriteria_kode' => 'C1', 'kode' => 'C1.2', 'nama' => 'Rp 500.000 - Rp 1.000.000', 'nilai' => 2],
            ['kriteria_kode' => 'C1', 'kode' => 'C1.3', 'nama' => 'Rp 1.000.000 - Rp 2.000.000', 'nilai' => 3],
            ['kriteria_kode' => 'C1', 'kode' => 'C1.4', 'nama' => 'Rp 2.000.000 - Rp 3.000.000', 'nilai' => 4],
            ['kriteria_kode' => 'C1', 'kode' => 'C1.5', 'nama' => 'Lebih dari Rp 3.000.000', 'nilai' => 5],
            
            // C2 Pekerjaan
            ['kriteria_kode' => 'C2', 'kode' => 'C2.1', 'nama' => 'PNS / TNI / Polri / Pegawai BUMN / Karyawan Tetap', 'nilai' => 1],
            ['kriteria_kode' => 'C2', 'kode' => 'C2.2', 'nama' => 'Karyawan Swasta / Wiraswasta Menengah', 'nilai' => 2],
            ['kriteria_kode' => 'C2', 'kode' => 'C2.3', 'nama' => 'Pedagang Kecil / Buruh Pabrik', 'nilai' => 3],
            ['kriteria_kode' => 'C2', 'kode' => 'C2.4', 'nama' => 'Buruh Tani / Buruh Bangunan / Pekerja Harian Lepas', 'nilai' => 4],
            ['kriteria_kode' => 'C2', 'kode' => 'C2.5', 'nama' => 'Tidak Bekerja / Lansia / Sakit Keras', 'nilai' => 5],

            // C3 Tanggungan
            ['kriteria_kode' => 'C3', 'kode' => 'C3.1', 'nama' => '1 Orang', 'nilai' => 1],
            ['kriteria_kode' => 'C3', 'kode' => 'C3.2', 'nama' => '2 Orang', 'nilai' => 2],
            ['kriteria_kode' => 'C3', 'kode' => 'C3.3', 'nama' => '3 Orang', 'nilai' => 3],
            ['kriteria_kode' => 'C3', 'kode' => 'C3.4', 'nama' => '4 Orang', 'nilai' => 4],
            ['kriteria_kode' => 'C3', 'kode' => 'C3.5', 'nama' => '5 Orang', 'nilai' => 5],

            // C4 Kondisi Rumah
            ['kriteria_kode' => 'C4', 'kode' => 'C4.1', 'nama' => 'Tembok permanen, lantai keramik bagus', 'nilai' => 1],
            ['kriteria_kode' => 'C4', 'kode' => 'C4.2', 'nama' => 'Tembok permanen, lantai semen/plester', 'nilai' => 2],
            ['kriteria_kode' => 'C4', 'kode' => 'C4.3', 'nama' => 'Semi permanen (tembok setengah & kayu)', 'nilai' => 3],

            // C5 Daya Listrik Rumah
            ['kriteria_kode' => 'C5', 'kode' => 'C5.1', 'nama' => 'Numpang tetangga / Tidak ada listrik', 'nilai' => 1],
            ['kriteria_kode' => 'C5', 'kode' => 'C5.2', 'nama' => '450 VA (Subsidi)', 'nilai' => 2],
            ['kriteria_kode' => 'C5', 'kode' => 'C5.3', 'nama' => '900 VA', 'nilai' => 3],
            ['kriteria_kode' => 'C5', 'kode' => 'C5.4', 'nama' => '1300 VA', 'nilai' => 4],
            ['kriteria_kode' => 'C5', 'kode' => 'C5.5', 'nama' => 'Lebih dari 1300 VA (2200 VA ke atas)', 'nilai' => 5],

            // C6 Aset
            ['kriteria_kode' => 'C6', 'kode' => 'C6.1', 'nama' => 'Tidak memiliki aset bernilai (hanya perabot dasar)', 'nilai' => 1],
            ['kriteria_kode' => 'C6', 'kode' => 'C6.2', 'nama' => 'Memiliki alat elektronik dasar (TV/Kulkas kecil)', 'nilai' => 2],
            ['kriteria_kode' => 'C6', 'kode' => 'C6.3', 'nama' => 'Memiliki hewan ternak kecil (ayam/kambing) / kebun sempit', 'nilai' => 3],
            ['kriteria_kode' => 'C6', 'kode' => 'C6.4', 'nama' => 'Memiliki tanah/sawah/kebun yang cukup luas', 'nilai' => 4],
            ['kriteria_kode' => 'C6', 'kode' => 'C6.5', 'nama' => 'Memiliki banyak aset berharga / perhiasan besar / mobil', 'nilai' => 5],

            // C7 Jumlah Kepemilikan Kendaraan Bermotor
            ['kriteria_kode' => 'C7', 'kode' => 'C7.1', 'nama' => 'Tidak memiliki kendaraan bermotor', 'nilai' => 1],
            ['kriteria_kode' => 'C7', 'kode' => 'C7.2', 'nama' => '1 Motor (Kondisi tua/bekas)', 'nilai' => 2],
            ['kriteria_kode' => 'C7', 'kode' => 'C7.3', 'nama' => '1 Motor (Keluaran baru/layak)', 'nilai' => 3],
            ['kriteria_kode' => 'C7', 'kode' => 'C7.4', 'nama' => 'Lebih dari 1 Motor', 'nilai' => 4],
            ['kriteria_kode' => 'C7', 'kode' => 'C7.5', 'nama' => 'Memiliki Mobil', 'nilai' => 5],
        ];

        // Cache kriteria id based on kode to avoid querying inside loop
        $kriterias = Kriteria::all()->keyBy('kode');

        foreach ($subKriteriaData as $data) {
            $kriteria = $kriterias->get($data['kriteria_kode']);
            
            if ($kriteria) {
                SubKriteria::create([
                    'kriteria_id' => $kriteria->id,
                    'kode' => $data['kode'],
                    'nama' => $data['nama'],
                    'nilai' => $data['nilai'],
                ]);
            }
        }
    }
}
