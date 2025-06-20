<?php namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quiz_results';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'score', 'completed', 'created_at'];

    public function getUserQuiz($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('completed', 0)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }
}