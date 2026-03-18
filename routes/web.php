<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatController;

// Home page
Route::get('/', [HomeController::class, 'index']);

// CV Download
Route::get('/download-cv', [HomeController::class, 'downloadCV'])->name('cv.download');

// Contact form
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// AI Chatbot — POST only, no page needed
Route::post('/chat', [ChatController::class, 'chat'])->name('chat');