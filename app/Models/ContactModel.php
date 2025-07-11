<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $allowedFields = ['name', 'email', 'message'];
    protected $useTimestamps = true;
}
