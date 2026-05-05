<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    // app/Config/Validation.php (or create ApplicantRules.php)
    public $applicant = [
        // Personal
        'full_name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[applicants.email]',
        'phone' => 'required|regex_match[/^[+]?[0-9\s\-()]{10,20}$/]',
        'emergency_contact_phone' => 'required|regex_match[/^[+]?[0-9\s\-()]{10,20}$/]',
        'place_of_birth' => 'required|min_length[2]|max_length[50]',
        'date_of_birth' => "required|valid_date|is_not_a_child[date_of_birth]",
        'gender' => 'required|in_list[male,female]',
        'id_number' => 'required|min_length[10]|max_length[50]',

        // Address
        'home_address' => 'required|min_length[10]',
        'mailing_address' => 'required|min_length[10]',
        'country' => 'required|min_length[2]',

        // Academic
        'program_level' => 'required|in_list[master,doctoral]',
        'study_program' => 'required|min_length[3]',
        'available_days' => 'required|min_length[1]',
        'last_university' => 'required|min_length[3]|max_length[100]',

        // File
        'documents' => 'uploaded[documents]|mime_in[documents,application/zip,application/x-rar-compressed]|max_size[documents,19456]', // 19MB
    ];
}
