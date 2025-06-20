<?php

namespace Config;

// Buat instance baru dari kelas RouteCollection kami.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Pengaturan Router
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth'); // Arahkan ke Auth secara default
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/*
 * --------------------------------------------------------------------
 * Definisi Rute
 * --------------------------------------------------------------------
 */

// Rute default mengarah ke halaman login.
$routes->get('/', 'Auth::login');

// Rute untuk proses Autentikasi
$routes->get('login', 'Auth::login');
$routes->post('login/attempt', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// Grup rute yang memerlukan login (dilindungi oleh filter 'auth')
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    // Rute tunggal untuk Dashboard. Controller akan menentukan tampilan.
    $routes->get('dashboard', 'Dashboard::index');
    
    // Rute untuk Game (hanya untuk peran 'user')
    $routes->get('game', 'Game::index');          // -> Inisialisasi & reset game
    $routes->get('game/play', 'Game::play');        // -> Menampilkan soal (ini yang menyebabkan 404)
    $routes->post('game/answer', 'Game::answer');     // -> Memproses jawaban
    $routes->get('game/result', 'Game::result');      // -> Menampilkan hasil akhir
});