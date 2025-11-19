<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\InstagramPostController;
use App\Http\Controllers\OngoingProjectController;
use App\Http\Controllers\ProjectDoneController;
use App\Http\Controllers\DesainInteriorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\ContactController;

// ==== Admin ====
Route::POST('/register', [AdminController::class,'register']);
Route::POST('/login', [AdminController::class, 'login']);
Route::POST('/logout', [AdminController::class, 'logout']);
Route::POST('/dashboard', [AdminController::class, 'redirectDashboard']);
Route::POST('/send-feedback', [FeedbackController::class, 'sendFeedback']);

// === Statistic Controller ===
Route::get('/statistic/{statis}', [StatisticController::class, 'index']);
Route::post('/statistic', [StatisticController::class, 'store']);
Route::put('/statistic/{statis}', [StatisticController::class, 'update']);
Route::delete('/statistic/{statis}', [StatisticController::class, 'destroy']);

// ==== Instagram Posts ====
Route::get('/post/{post}', [InstagramPostController::class, 'index']);
Route::post('/post', [InstagramPostController::class, 'store']);
Route::put('/post/{post}', [InstagramPostController::class, 'updatePost']);
Route::delete('/post/{post}', [InstagramPostController::class, 'destroy']);
Route::patch('/post/{post}', [InstagramPostController::class, 'viewTshowoHome']);

// ===== FAQ =====
Route::get('/faq', [FaqController::class, 'index']);
Route::post('/faq', [FaqController::class, 'store']);
Route::get('/faq/{faq}', [FaqController::class, 'show']);
Route::put('/faq/{faq}', [FaqController::class, 'update']);
Route::delete('/faq/{faq}', [FaqController::class, 'destroy']);

// ===== Testimoni =====
Route::get('/testimoni/{tstmn}', [TestimoniController::class, 'index']);
Route::post('/testimoni', [TestimoniController::class, 'store']);
Route::put('/testimoni/{tstmn}', [TestimoniController::class, 'update']);
Route::delete('/testimoni/{tstmn}', [TestimoniController::class, 'destroy']);

// ==== Ongoing Project =====
Route::get('/ongoing-project/{OP}', [OngoingProjectController::class, 'index']);
Route::post('/ongoing-project', [OngoingProjectController::class, 'store']);
Route::put('/ongoing-project/{OP}', [OngoingProjectController::class, 'update']);
Route::delete('/ongoing-project/{OP}', [OngoingProjectController::class, 'destroy']);


// ==== Project Done =====
Route::post('/project-done', [ProjectDoneController::class, 'index']);
Route::get('/project-done/{PD}', [ProjectDoneController::class, 'store']);
Route::put('/project-done/{PD}', [ProjectDoneController::class, 'update']);
Route::delete('/project-done/{PD}', [ProjectDoneController::class, 'destroy']);

// ==== Desain Interior ====
Route::get('/desain-interior', [DesainInteriorController::class, 'index']);
Route::post('desain-interior', [DesainInteriorController::class, 'store']);
Route::put('/desain-interior', [DesainInteriorController::class, 'update']);
Route::delete('/desain-interior', [DesainInteriorController::class, 'destroy']);

// Contact
Route::get('/contact/{cont}', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::put('/contact/{cont}', [ContactController::class, 'update']);
Route::delete('/contact/{cont}', [ContactController::class, 'destroy']);