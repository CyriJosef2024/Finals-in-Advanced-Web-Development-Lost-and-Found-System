<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTable extends Migration
{
    public function up()
    {
        // Items table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['lost', 'found'],
                'default' => 'lost',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'date_occurred' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'contact_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'contact_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'contact_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['open', 'claimed', 'resolved'],
                'default' => 'open',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('items');

        // Optional: Claims table (uncomment if you want full claim tracking)
        /*
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'claimant_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'claimant_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'claimed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('item_id', 'items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('claims');
        */
    }

    public function down()
    {
        $this->forge->dropTable('claims', true); // if you added it
        $this->forge->dropTable('items', true);
    }
}
