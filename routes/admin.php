<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AdmissionNoticeController;
use App\Http\Controllers\CampusGalaryController;
use App\Http\Controllers\EventsController;

Route::controller(AdminController::class)->group(function() {
    Route::get('admin/login', 'index')->name('admin.index');
    Route::post('admin/login', 'store')->name('admin.store');
});

Route::group(['prefix' => 'admin'], function () {
    
    Route::group(['middleware' => 'adminauth'], function () {

        Route::controller(AdminController::class)->group(function() {
            Route::get('dashboard', 'create')->name('admin.dashboard')->middleware('admin');
            Route::get('logout', 'logout')->name('admin.logout');
        });

        Route::controller(NewsController::class)->group(function() {
            Route::get('all-news', 'create')->name('news.create');
            Route::post('store-news', 'store')->name('news.store');
            Route::get('shows-news', 'show')->name('news.show');
            Route::post('destroy-news', 'destroy')->name('news.destroy');
        });

        Route::controller(NoticeController::class)->group(function() {
            Route::get('all-notice', 'create')->name('notice.create');
            Route::post('store-notice', 'store')->name('notice.store');
            Route::get('shows-notice', 'show')->name('notice.show');
            Route::post('destroy-notice', 'destroy')->name('notice.destroy');
        });

        Route::controller(AdmissionNoticeController::class)->group(function() {
            Route::get('all-admission-notice', 'create')->name('admissionnotice.create');
            Route::post('store-admissionnotice', 'store')->name('admissionnotice.store');
            Route::get('shows-admissionnotice', 'show')->name('admissionnotice.show');
            Route::post('destroy-admissionnotice', 'destroy')->name('admissionnotice.destroy');
        });

        Route::controller(CampusGalaryController::class)->group(function() {
            Route::get('all-campus-galary', 'create')->name('campusgalary.create');
            Route::post('store-campus-galary', 'store')->name('campusgalary.store');
            Route::get('shows-campus-galary', 'show')->name('campusgalary.show');
            Route::post('destroy-campus-galary', 'destroy')->name('campusgalary.destroy');
        });

        Route::controller(ContactUsController::class)->group(function() {
            Route::get('/contact-list',  'create')->name('contact.create');
            Route::get('/contact-show',  'show')->name('contact.show');
            Route::post('/contact-status-change', 'update')->name('contact.update');
            Route::post('/contact-destroy',  'destroy')->name('contact.destroy');
        });

        Route::controller(EventsController::class)->group(function() {
            Route::get('all-events', 'create')->name('events.create');
            Route::post('store-events', 'store')->name('events.store');
            Route::get('shows-events', 'show')->name('events.show');
            Route::post('destroy-events', 'destroy')->name('events.destroy');
        });
    });
});