<?php

use App\Http\Controllers\DesainInteriorController;
use App\Http\Controllers\OngoingProjectController;
use App\Http\Controllers\ProjectDoneController;
use App\Models\desainInterior;
use App\Models\Faq;
use App\Models\InstagramPost;
use App\Models\ongoingProjects;
use App\Models\projectDone;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstagramPostController;

Route::get('/', function () {
    $posts = InstagramPost::all();
    return view('home', ['posts' => $posts]);
});

Route::get('/dashboard', function () {
    $posts = InstagramPost::latest()->get();
    $faqs = Faq::latest()->get();
    $PDs = projectDone::latest()->get();
    $OPs = ongoingProjects::latest()->get();
    $DIs= desainInterior::latest()->get();
    
    return view('dashboard', [
        'posts' => $posts,
        'faqs' => $faqs,
        'PDs' => $PDs,
        'OPs' => $OPs,
        'DIs' => $DIs
    ]);
});

Route::POST('/register', [AdminController::class,'register']);
Route::POST('/login', [AdminController::class, 'login']);
Route::POST('/logout', [AdminController::class, 'logout']);
Route::POST('/dashboard', [AdminController::class, 'redirectDashboard']);

// Instagram Posts
Route::post('/create-post', [InstagramPostController::class, 'createPost']);
Route::get('/edit-post/{post}', [InstagramPostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [InstagramPostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [InstagramPostController::class, 'deletePost']);

// FAQ
Route::post('/create-faq', [FaqController::class, 'createFAQ']);
Route::get('/edit-faq/{faq}', [FaqController::class, 'showEditScreen']);
Route::put('/edit-faq/{faq}', [FaqController::class, 'updateFAQ']);
Route::delete('/delete-faq/{faq}', [FaqController::class, 'deleteFAQ']);

// Ongoing Project
Route::post('/create-ongoing-project', [OngoingProjectController::class, 'createOP']);
Route::get('/edit-ongoing-project/{OP}', [OngoingProjectController::class, 'showEditScreen']);
Route::put('/edit-ongoing-project/{OP}', [OngoingProjectController::class, 'updateOP']);
Route::delete('/delete-ongoing-project/{OP}', [OngoingProjectController::class, 'deleteOP']);

// Project Done
Route::post('/create-project-done', [ProjectDoneController::class, 'createPD']);
Route::get('/edit-project-done/{PD}', [ProjectDoneController::class, 'showEditScreen']);
Route::put('/edit-project-done/{PD}', [ProjectDoneController::class, 'updatePD']);
Route::delete('/delete-project-done/{PD}', [ProjectDoneController::class, 'deletePD']);

// Desain Interior
Route::post('/create-desain-interior', [DesainInteriorController::class, 'createDI']);
Route::get('/edit-desain-interior/{DI}', [DesainInteriorController::class, 'showEditScreen']);
Route::put('/edit-desain-interior/{DI}', [DesainInteriorController::class, 'updateDI']);
Route::delete('/delete-desain-interior/{DI}', [DesainInteriorController::class, 'deleteDI']);