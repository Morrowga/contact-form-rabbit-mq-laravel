<?php

use App\Models\Contact;
use App\Mail\MailToOwner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//  Contact Creation Form UI
Route::get('/', [ContactController::class, 'create'])->name('contact.create');

//  Contact Creation Form Submit
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth Disabled 
Auth::routes(['register' => false, 'login' => false]);
