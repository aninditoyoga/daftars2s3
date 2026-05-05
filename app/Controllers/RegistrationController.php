<?php
namespace App\Controllers;

use App\Models\ApplicantModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class RegistrationController extends BaseController
{
    protected ApplicantModel $applicantModel;
    protected $validation;

    public function __construct()
    {
        helper('form');
        $this->applicantModel = new ApplicantModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'study_programs' => [
                'master' => [
                    'Islamic Economics',
                    'Islamic Religious Education',
                    'Quran and Tafsir Studies',
                    'Islamic Education Management',
                    'Islamic Family Law',
                    'Sharia Economic Law',
                    'Islamic Community Development',
                    'Philosophy of Religion',
                    'Arabic Language Education'
                ],
                'doctoral' => [
                    'Islamic Education Management',
                    'Islamic Family Law',
                    'Islamic Community Development',
                    'Islamic Economics'
                ]
            ],
            'countries' => $this->getCountriesList(),
            'days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'validation' => $this->validation
        ];
        return view('registration/form', $data);
    }

    public function store()
    {
        $rules = $this->applicantModel->getValidationRules();
        $rules['documents'] = 'uploaded[documents]|max_size[documents,19000]|ext_in[documents,zip,rar]';

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('documents');
        if (!$file->isValid()) {
            return redirect()->back()->withInput()->with('errors', ['documents' => 'Please upload a valid ZIP or RAR file under 19MB.']);
        }

        $uploadPath = WRITEPATH . 'uploads/documents';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = $file->getRandomName();
        $file->move($uploadPath, $fileName);

        // Generate registration number
        $regNumber = 'REG-' . date('Y') . '-' . strtoupper(bin2hex(random_bytes(4)));

        // Generate VA Payment (integrate with BNI API)
        $vaNumber = '882901' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);

        $this->applicantModel->save([
            'registration_number' => $regNumber,
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'emergency_contact_name' => $this->request->getPost('emergency_contact_name'),
            'emergency_contact_phone' => $this->request->getPost('emergency_contact_phone'),
            'place_of_birth' => $this->request->getPost('place_of_birth'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'gender' => $this->request->getPost('gender'),
            'height' => $this->request->getPost('height'),
            'blood_type' => $this->request->getPost('blood_type'),
            'id_number' => $this->request->getPost('id_number'),
            'home_address' => $this->request->getPost('home_address'),
            'mailing_address' => $this->request->getPost('mailing_address'),
            'country' => $this->request->getPost('country'),
            'program_level' => $this->request->getPost('program_level'),
            'study_program' => $this->request->getPost('study_program'),
            'available_days' => json_encode($this->request->getPost('available_days') ?? []),
            'last_university' => $this->request->getPost('last_university'),
            'toefl_toafl_score' => $this->request->getPost('toefl_toafl_score'),
            'occupation' => $this->request->getPost('occupation'),
            'marital_status' => $this->request->getPost('marital_status'),
            'documents_path' => 'uploads/documents/' . $fileName,
            'file_size_mb' => round($file->getSize() / 1024 / 1024, 2),
            'payment_va' => $vaNumber,
            'application_status' => 'submitted'
        ]);

        $this->sendConfirmationEmail($this->request->getPost('email'), $regNumber, $vaNumber);

        return redirect()->to('/registration/success')->with('reg_number', $regNumber)->with('va_number', $vaNumber);
    }

    public function success()
    {
        return view('registration/success', [
            'regNumber' => session('reg_number'),
            'vaNumber' => session('va_number'),
        ]);
    }

    public function checkEmail()
    {
        $email = $this->request->getPost('email');
        $exists = $this->applicantModel->where('email', $email)->first() !== null;
        return $this->response->setJSON(['exists' => $exists]);
    }

    private function getCountriesList(): array
    {
        return [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Cape Verde',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czech Republic',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'East Timor',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Honduras',
            'Hong Kong',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Ivory Coast',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Kosovo',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Macao',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Korea',
            'North Macedonia',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Palestine',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Vincent and the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Korea',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Sweden',
            'Switzerland',
            'Syria',
            'Taiwan',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Togo',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Vatican City',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe'
        ];
    }

    private function sendConfirmationEmail($email, $regNumber, $vaNumber)
    {
        // Implement email service with PHPMailer or similar
    }
}