<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AdmissionNoticeController;

Route::controller(AdminController::class)->group(function() {
    Route::get('admin/login', 'index')->name('admin.index');
    Route::post('admin/login', 'store')->name('admin.store');
});


Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function () {
    
    Route::controller(AdminController::class)->group(function() {
        Route::get('dashboard', 'create')->name('admin.dashboard');
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

    Route::controller(ContactUsController::class)->group(function() {
        Route::get('/contact-list',  'create')->name('contact.create');
        Route::get('/contact-show',  'show')->name('contact.show');
        Route::post('/contact-status-change', 'update')->name('contact.update');
        Route::post('/contact-destroy',  'destroy')->name('contact.destroy');
    });
    
});