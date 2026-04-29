<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteriaData = [
            [
                'kode' => 'C1',
                'nama' => 'Penghasilan',
                'atribut' => 'Cost',
                'bobot' => 0.25,
            ],
            [
                'kode' => 'C2',
                'nama' => 'Pekerjaan',
                'atribut' => 'Benefit',
                'bobot' => 0.20,
            ],
            [
                'kode' => 'C3',
                'nama' => 'Tanggungan',
                'atribut' => 'Benefit',
                'bobot' => 0.15,
            ],
            [
                'kode' => 'C4',
                'nama' => 'Kondisi Rumah',
                'atribut' => 'Benefit',
                'bobot' => 0.15,
            ],
            [
                'kode' => 'C5',
                'nama' => 'Daya Listrik Rumah',
                'atribut' => 'Cost',
                'bobot' => 0.10,
            ],
            [
                'kode' => 'C6',
                'nama' => 'Aset',
                'atribut' => 'Cost',
                'bobot' => 0.10,
            ],
            [
                'kode' => 'C7',
                'nama' => 'Jumlah Kepemilikan Kendaraan Bermotor',
                'atribut' => 'Cost',
                'bobot' => 0.05,
            ],
        ];

        foreach ($kriteriaData as $data) {
            Kriteria::create($data);
        }
    }
}
