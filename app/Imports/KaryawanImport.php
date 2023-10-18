<?php

namespace App\Imports;

use App\Models\karyawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class KaryawanImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // Pastikan indeks kolom sesuai dengan struktur data Excel
        return new karyawan([
            'karyawan_name' => $row[0],
            'karyawan_kebun' => $row[1],
            'karyawan_jenis' => $row[2],
            'karyawan_nomor' => $row[3],
            'karyawan_tanggal' => $row[4],
            'karyawan_masa' => $row[5],

        ]);
    }
}
