<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'registration_number' => ['type' => 'VARCHAR', 'constraint' => 20],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'emergency_contact_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'emergency_contact_phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'place_of_birth' => ['type' => 'VARCHAR', 'constraint' => 50],
            'date_of_birth' => ['type' => 'DATE'],
            'gender' => ['type' => 'ENUM', 'constraint' => ['male', 'female']],
            'height' => ['type' => 'INT', 'null' => true],
            'blood_type' => ['type' => 'ENUM', 'constraint' => ['A', 'B', 'AB', 'O'], 'null' => true],
            'id_number' => ['type' => 'VARCHAR', 'constraint' => 50],
            'home_address' => ['type' => 'TEXT'],
            'mailing_address' => ['type' => 'TEXT'],
            'country' => ['type' => 'VARCHAR', 'constraint' => 100],
            'program_level' => ['type' => 'ENUM', 'constraint' => ['master', 'doctoral']],
            'study_program' => ['type' => 'VARCHAR', 'constraint' => 100],
            'available_days' => ['type' => 'JSON'],
            'last_university' => ['type' => 'VARCHAR', 'constraint' => 100],
            'toefl_toafl_score' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'occupation' => ['type' => 'VARCHAR', 'constraint' => 50],
            'marital_status' => ['type' => 'ENUM', 'constraint' => ['single', 'married', 'widowed', 'divorced']],
            'documents_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_size_mb' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'payment_va' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'payment_status' => ['type' => 'ENUM', 'constraint' => ['pending', 'paid', 'verified'], 'default' => 'pending'],
            'application_status' => ['type' => 'ENUM', 'constraint' => ['draft', 'submitted', 'reviewed', 'accepted', 'rejected'], 'default' => 'draft'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        // ✅ Kunci Fix: Gunakan method eksplisit, jangan campur 'unique' => true di addField
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('registration_number');
        $this->forge->addKey('email'); // Regular index

        $this->forge->createTable('applicants');
    }

    public function down()
    {
        $this->forge->dropTable('applicants');
    }
}