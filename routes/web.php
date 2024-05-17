<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\NewsLettersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('newsletter',[
//     'uses'=>'NewsLetterController@create',
//     'as'=>'newsletter'
// ]);
// Route::post('apply',[
//     'uses'=>'NewsLetterController@store',
//     'as'=>'apply'
// ]);


Route::post('apply-two',[
    'uses'=>'NewsLetterController@autoMail',
    'as'=>'apply-two'
]);

// Route::post('apply',[NewsletterController::class,'create',
// 'as'=>'apply'
// ]);

Route::get('newsletter',[NewsletterController::class,'create',
'as'=>'newsletter'
]);

Route::post('apply-two',[NewsletterController::class,'store',
'as'=>'apply-two'
]);

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('newsletters',[NewsletterController::class,'create',
'as'=>'create'
]);


// Check Subscriber Email
Route::post('/check-subscriber-email','NewsletterController@checkSubscriber');

Route::post('/add-subscriber-email',[NewslettersController::class,'addSubscriber'])->name('addSubscriber');

##############

// View Newsletter Subscribers
Route::get('admin/view-newsletter-subscribers','NewsletterController@viewNewsletterSubscribers');

// Update Newsletter Status
Route::get('admin/update-newsletter-status/{id}/{status}','NewsletterController@updateNewsletterStatus');

// Delete Newsletter Email
Route::get('admin/delete-newsletter-email/{id}','NewsletterController@deleteNewsletterEmail');

// Export Newsletter Emails
Route::get('/admin/export-newsletter-emails','NewsletterController@exportNewsletterEmails');
