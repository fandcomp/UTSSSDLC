<?php
// File: app/Models/QuestionModel.php
namespace App\Models;
use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $allowedFields = ['question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct', 'level'];

    public function getQuestionForLevel(int $level, array $excludeIds = [])
    {
        $builder = $this->where('level', $level);
        if (!empty($excludeIds)) { $builder->whereNotIn('id', $excludeIds); }
        return $builder->orderBy('RAND()')->first();
    }
    public function countTotalLevels(): int
    {
        return $this->selectMax('level', 'max_level')->get()->getRow('max_level') ?? 1;
    }
    public function getAllQuestions(): array
    {
        return $this->orderBy('level', 'ASC')->orderBy('id', 'ASC')->findAll();
    }
}