<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'registration_number' => 'REG-TEST-001',
            'full_name' => 'John Doe Test',
            'email' => 'test@example.com',
            'phone' => '+628123456789',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_phone' => '+628987654321',
            'place_of_birth' => 'Bandar Lampung',
            'date_of_birth' => '1995-05-15',
            'gender' => 'male',
            'height' => 175,
            'blood_type' => 'O',
            'id_number' => '3371011234567890',
            'home_address' => 'Jl. ZA Pagar Alam No. 15, Bandar Lampung',
            'mailing_address' => 'Jl. ZA Pagar Alam No. 15, Bandar Lampung',
            'country' => 'Indonesia',
            'program_level' => 'master',
            'study_program' => 'Islamic Economics',
            'available_days' => json_encode(['Monday', 'Wednesday', 'Friday']),
            'last_university' => 'UIN Raden Intan Lampung',
            'toefl_toafl_score' => 520.50,
            'occupation' => 'Private Employee',
            'marital_status' => 'single',
            'documents_path' => 'uploads/documents/test_docs.zip',
            'file_size_mb' => 15.20,
            'payment_va' => '88290112345678',
            'payment_status' => 'pending',
            'application_status' => 'submitted',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('applicants')->insert($data);
    }
}