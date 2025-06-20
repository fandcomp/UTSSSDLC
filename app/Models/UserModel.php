<?php
// File: app/Models/UserModel.php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'role'];
    public function getUserByUsername(string $username){ return $this->where('username', $username)->first(); }
}