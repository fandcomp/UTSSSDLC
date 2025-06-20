<?php
// File: app/Models/QuizResultModel.php
namespace App\Models;
use CodeIgniter\Model;

class QuizResultModel extends Model
{
    protected $table = 'quiz_results';
    protected $allowedFields = ['user_id', 'score', 'completed'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}