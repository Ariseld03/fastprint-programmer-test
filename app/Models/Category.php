<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_kategori'];
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
            if ($this->normalize($row['nama_kategori']) === $normalizedInput) {
                return (int) $row['id_kategori'];
            }
        }

        $this->insert([
            'nama_kategori' => trim($name),
        ]);

        return (int) $this->getInsertID();
    }

}
