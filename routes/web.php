<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AdmissionNoticeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\EventRegisterController;

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
//     return 'link create successfully !';
// });

// Route::get('/clear-cache', function () {
//     Artisan::call('route:cache');
//     Artisan::call('view:clear');
//     Artisan::call('view:clear');
//     return 'Routes cache has clear successfully !';
// });

///Website 
Route::controller(HomeController::class)->group(function() {
    Route::get('/',  'index')->name('web.home');
    Route::get('/general',  'general')->name('web.general');
    Route::get('/about-us',  'aboutus')->name('web.aboutus');
    Route::get('/principals-desk',  'principalsdesk')->name('web.principalsdesk');
    Route::get('/school-timings',  'schooltimings')->name('web.schooltimings');
    Route::get('/school-uniform',  'schooluniform')->name('web.schooluniform');
    Route::get('/rules-regulations',  'rulesregulations')->name('web.rulesregulations');
    Route::get('/co-curricular',  'cocurricular')->name('web.cocurricular');
    Route::get('/terms-conditions',  'termsConditions')->name('web.termsConditions');
    Route::get('/privacy-policy',  'privacyPolicy')->name('web.privacyPolicy');
    
    
});

Route::controller(NewsController::class)->group(function() {
    Route::get('/news',  'index')->name('web.news');
    Route::get('/news-details/{slug}',  'edit')->name('web.edit');
});

Route::controller(ContactUsController::class)->group(function() {
    Route::get('/contact-us',  'index')->name('web.contact');
    Route::post('/contact-store',  'store')->name('web.contact.store');
});

Route::controller(NoticeController::class)->group(function() {
    Route::get('/notice',  'index')->name('web.notice');
});

Route::controller(AdmissionNoticeController::class)->group(function() {
    Route::get('/admission-notice',  'index')->name('web.admissionnotice');
});

Route::controller(EventsController::class)->group(function() {
    Route::get('/events',  'index')->name('web.events');
    Route::get('/events-details/{slug}',  'edit')->name('web.events.edit');
});

Route::controller(EventRegisterController::class)->group(function() {
    Route::post('/store-events-register',  'store')->name('web.eventsregister');
});