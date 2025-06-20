<?php
// File: app/Controllers/Dashboard.php (Logika Peran Diterapkan di Sini)
namespace App\Controllers;

use App\Models\QuestionModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        
        // **INI ADALAH LOGIKA UTAMA PEMBAGIAN TAMPILAN**
        if ($session->get('role') === 'admin') {
            // Jika peran adalah 'admin', ambil semua soal dan tampilkan view admin
            $questionModel = new QuestionModel();
            $data['questions'] = $questionModel->getAllQuestions();
            return view('admin_dashboard', $data);
        } else {
            // Jika peran adalah 'user' (atau lainnya), tampilkan dashboard permainan biasa
            return view('dashboard');
        }
    }
}