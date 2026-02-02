<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        //$this->db->table('status')->truncate();
        $data=[
            ['nama_status'=>'bisa dijual'],
            ['nama_status'=>'tidak bisa dijual'],
        ];
        $this->db->table('status')->insertBatch($data);
    }
}
