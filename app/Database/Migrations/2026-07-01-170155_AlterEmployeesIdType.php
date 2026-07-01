<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterEmployeesIdType extends Migration
{
    public function up()
    {
        // Define our custom id column structure as a VARCHAR string
        $fields = [
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'auto_increment' => false, // Turn off auto-increment!
            ],
        ];
        
        $this->forge->modifyColumn('employees', $fields);
    }

    public function down()
    {
        // Rollback strategy to revert back to sequential integer
        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
        ];
        $this->forge->modifyColumn('employees', $fields);
    }
}