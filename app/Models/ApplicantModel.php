<?php
namespace App\Models;

use CodeIgniter\Model;

class ApplicantModel extends Model
{
    protected $table = 'applicants';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'registration_number',
        'full_name',
        'email',
        'phone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'height',
        'blood_type',
        'id_number',
        'home_address',
        'mailing_address',
        'country',
        'program_level',
        'study_program',
        'available_days',
        'last_university',
        'toefl_toafl_score',
        'occupation',
        'marital_status',
        'documents_path',
        'file_size_mb',
        'payment_va',
        'payment_status',
        'application_status'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'full_name' => 'required|max_length[100]',
        'email' => 'required|valid_email|max_length[100]|is_unique[applicants.email]',
        'phone' => 'required|max_length[20]',
        'emergency_contact_name' => 'required|max_length[100]',
        'emergency_contact_phone' => 'required|max_length[20]',
        'place_of_birth' => 'required|max_length[50]',
        'date_of_birth' => 'required|valid_date[Y-m-d]',
        'gender' => 'required|in_list[male,female]',
        'id_number' => 'required|max_length[50]',
        'home_address' => 'required',
        'mailing_address' => 'required',
        'country' => 'required|max_length[100]',
        'program_level' => 'required|in_list[master,doctoral]',
        'study_program' => 'required|max_length[100]',
        'last_university' => 'required|max_length[100]',
        'toefl_toafl_score' => 'permit_empty|decimal',
        'occupation' => 'permit_empty|max_length[50]',
        'marital_status' => 'permit_empty|in_list[single,married,widowed,divorced]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email has already been registered.',
        ],
        'documents' => [
            'uploaded' => 'Please upload your application documents.',
            'max_size' => 'Document file must not exceed 19MB.',
            'ext_in' => 'Allowed file types are ZIP and RAR.'
        ]
    ];
}
