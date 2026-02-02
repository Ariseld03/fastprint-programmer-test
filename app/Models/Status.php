<?php

namespace App\Models;

use CodeIgniter\Model;

class Status extends Model
{
    protected $table            = 'status';
    protected $primaryKey       = 'id_status';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_status'];

    protected function normalize(string $value): string
    {
        return strtolower(
            preg_replace('/\s+/', '', trim($value))
        );
    }

     public function getOrCreateIdByName(string $name): int
    {
        $normalizedInput = $this->normalize($name);

        $rows = $this->findAll();

        foreach ($rows as $row) {
            if ($this->normalize($row['nama_status']) === $normalizedInput) {
                return (int) $row['id_status'];
            }
        }

        $this->insert([
            'nama_status' => trim($name),
        ]);

        return (int) $this->getInsertID();
    }
}
