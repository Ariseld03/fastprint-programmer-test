<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
   public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'harga' => [
                'type'       => 'INT',
                'constraint' => 10,
            ],
            'kategori_id' => [
                'type'       => 'INT',
                'unsigned'     => true,
            ],
            'status_id' => [
                'type'       => 'INT',
                'unsigned'     => true,
            ],
        ]);

        $this->forge->addKey('id_produk', true);
        $this->forge->addKey('status_id');
        $this->forge->addKey('kategori_id');
        $this->forge->addForeignKey(
            'status_id',
            'status',
            'id_status',
            'CASCADE',
            'CASCADE'
        );
        $this->forge->addForeignKey(
            'kategori_id',
            'kategori',
            'id_kategori',
            'CASCADE',
            'CASCADE'
        );
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
