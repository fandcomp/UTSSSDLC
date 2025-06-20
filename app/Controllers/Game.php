<?php
// File: app/Controllers/Game.php (Logika Level Sudah Benar)
namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\QuizResultModel;

class Game extends BaseController
{
    const QUESTIONS_PER_LEVEL = 5;

    public function index()
    {
        $questionModel = new QuestionModel();
        session()->set([
            'score'             => 0,
            'current_level'     => 1,
            'total_levels'      => $questionModel->countTotalLevels(),
            'answered_in_level' => 0,
            'answered_ids'      => [],
        ]);
        return redirect()->to('game/play');
    }

    public function play()
    {
        $session = session();
        $questionModel = new QuestionModel();
        
        if ($session->get('answered_in_level') >= self::QUESTIONS_PER_LEVEL) {
            if ($session->get('current_level') < $session->get('total_levels')) {
                $session->set('current_level', $session->get('current_level') + 1);
                $session->set('answered_in_level', 0);
            } else {
                return redirect()->to('game/result');
            }
        }

        $question = $questionModel->getQuestionForLevel($session->get('current_level'), $session->get('answered_ids'));

        if (!$question) {
            return redirect()->to('game/result');
        }
        
        $data = [
            'question' => $question,
            'progress' => ($session->get('answered_in_level') / self::QUESTIONS_PER_LEVEL) * 100,
        ];

        return view('game_view', $data);
    }

    public function answer()
    {
        $session = session();
        $questionModel = new QuestionModel();
        $questionId = $this->request->getPost('question_id');
        $userAnswer = $this->request->getPost('answer');
        $correctQuestion = $questionModel->find($questionId);

        if ($correctQuestion && $correctQuestion['correct'] === $userAnswer) {
            $session->set('score', $session->get('score') + 20);
        }

        $answeredIds = $session->get('answered_ids');
        $answeredIds[] = $questionId;
        $session->set('answered_ids', $answeredIds);
        $session->set('answered_in_level', $session->get('answered_in_level') + 1);

        return redirect()->to('game/play');
    }

    public function result()
    {
        $session = session();
        if ($session->get('user_id')) {
            $resultModel = new QuizResultModel();
            $resultModel->save([
                'user_id' => $session->get('user_id'),
                'score'   => $session->get('score'),
                'completed' => 1
            ]);
        }
        
        $data = [
            'score' => $session->get('score'),
            'username' => $session->get('username')
        ];
        
        return view('result_view', $data);
    }
}