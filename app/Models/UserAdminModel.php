<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAdminModel extends Model
{
    protected $table = 'useradmin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['username', 'password', 'email', 'full_name', 'is_active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[useradmin.username,id,{id}]',
        'password' => 'required|min_length[6]',
        'email' => 'required|valid_email|is_unique[useradmin.email,id,{id}]',
        'full_name' => 'permit_empty|max_length[255]',
    ];
    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'is_unique' => 'Username already exists',
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please provide a valid email address',
            'is_unique' => 'Email already exists',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long',
        ],
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $afterInsert = [];
    protected $beforeUpdate = ['hashPassword'];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Hash password before insert/update
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Get user by username
     */
    public function getByUsername(string $username)
    {
        return $this->where('username', $username)->where('is_active', 1)->first();
    }

    /**
     * Get user by email
     */
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->where('is_active', 1)->first();
    }
}
