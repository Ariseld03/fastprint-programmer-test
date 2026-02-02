<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // $this->db->table('kategori')->truncate();
        $data=[
            ['nama_kategori'=>'L QUEENLY'],
            ['nama_kategori'=>'L MTH AKSESORIS (IM)'],
            ['nama_kategori'=>'L MTH TABUNG (LK)'],
            ['nama_kategori'=>'SP MTH SPAREPART (LK)'],
            ['nama_kategori'=>'CI MTH TINTA LAIN (IM)'],
            ['nama_kategori'=>'S MTH STEMPEL (IM)'],
            ['nama_kategori'=>'L MTH AKSESORIS (LK)'],
        ];
        $this->db->table('kategori')->insertBatch($data);
    }
}
