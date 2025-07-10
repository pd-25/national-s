<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AdmissionNoticeController;
use App\Http\Controllers\CampusGalaryController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\PaymentSettingsController;
use App\Http\Controllers\PayrollSettingsController;
use App\Http\Controllers\StudentFeeSettingsController;

Route::controller(AdminController::class)->group(function() {
    Route::get('admin/login', 'index')->name('admin.index');
    Route::post('admin/login', 'loginProcess')->name('admin.store');
});

Route::group(['prefix' => 'admin'], function () {
    
    Route::group(['middleware' => 'adminauth', ], function () {
        Route::group(['middleware' => 'rolemanage', ], function () {
            Route::controller(AdminController::class)->group(function() {
                Route::get('dashboard', 'create')->name('admin.dashboard')->middleware('admin');
                Route::get('logout', 'logout')->name('admin.logout');
            });
            // Attendance Management 
            Route::controller(MasterController::class)->group(function() {
                //Classes
                Route::get('manage-classes', 'manageClasses')->name('ams.manageClasses');
                Route::post('store-classes', 'addClasses')->name('ams.addClasses');
                Route::delete('delete-classes/{id}', 'destroyClasses')->name('ams.destroyClasses');
                //Section
                Route::get('manage-class-section', 'manageClassesSections')->name('ams.manageClassesSections');
                Route::get('get-arms-by-class-id/{class_id}', 'getclassarm')->name('ams.getclassarm');
                Route::post('store-classes-arms', 'addClassesSection')->name('ams.addClassesSection');
                Route::delete('delete-classes-arms/{id}', 'destroyClassesArms')->name('ams.destroyClassesArms');
                //Teacher
                Route::get('manage-teachers', 'manageTeacher')->name('ams.manageTeacher');
                Route::post('store-teacher', 'addTeacher')->name('ams.addTeacher');
                Route::delete('delete-teachers/{id}', 'destroyTeachers')->name('ams.destroyTeachers');
                //Sesssion
                Route::get('manage-session-term', 'manageSessionTerm')->name('ams.manageSessionTerm');
                Route::post('store-session', 'addSessionTerm')->name('ams.addSessionTerm');
                Route::delete('delete-session/{id}', 'destroySession')->name('ams.destroySession');
            });
            // Student Manage
            Route::controller(StudentController::class)->group(function() {
                Route::get('student-register', 'StudentRegister')->name('student.StudentRegister');
                Route::post('store-student', 'storeStudentDetails')->name('student.storeStudentDetails');
                Route::post('update-student', 'updateStudentDetails')->name('student.updateStudentDetails');
                Route::get('all-students', 'studentList')->name('student.studentList');
                Route::post('search-students', 'getStudentData')->name('student.getStudentData');
                Route::get('students-edit/{id}', 'studentEdit')->name('student.studentEdit');
                Route::get('students-view/{id}', 'studentView')->name('student.studentView');
                Route::post('destroy-students', 'destroy')->name('student.destroy');
                
                Route::post('student-list-session-class-section', 'studentsListUsingSessionClassSection')->name('attendance.studentsListUsingSessionClassSection');
                Route::get('students-entrollment', 'studentsEntrollment')->name('student.studentsEntrollment');
                Route::post('store-students-entrollment', 'studentsEntrollmentStore')->name('student.studentsEntrollmentStore');
                Route::get('entrollment-history', 'entrollmentHistory')->name('student.entrollmentHistory');
                Route::post('update-enrollemnt-students', 'updateEntrollmentHistory')->name('student.updateEntrollmentHistory');
                Route::post('delete-enrollemnt-students', 'deleteEnrollmentHistory')->name('student.deleteEnrollmentHistory');
                
                Route::post('session-student-details', 'sessionWiseStudent')->name('student.sessionWiseStudent');

                Route::get('students-class-wise-section', 'studentsClasWiseSection')->name('student.studentsClasWiseSection');
                Route::post('transfer-student-section', 'storeTransferStudents')->name('student.storeTransferStudents');
                
                //Reset password
                Route::get('students-reset-password', 'studentsResetPassword')->name('student.studentsResetPassword');
                Route::post('reset-password', 'resetPassword')->name('student.resetPassword');
                // Upload profile images
                Route::get('students-upload-profile-image', 'studentsUploadProfileImage')->name('student.studentsUploadProfileImage');
                Route::post('/student/upload-image', 'uploadImage')->name('student.uploadImage');

            });

            // Payment Fee
            Route::controller(DepositeController::class)->group(function() {
                Route::get('fees-payment', 'index')->name('deposite.index');
                Route::post('store-payment', 'store')->name('deposite.store');
                Route::get('payment-history', 'create')->name('deposite.create');
                Route::post('show-payment', 'show')->name('deposite.show');
                Route::get('edit-payment/{payment_number}', 'edit')->name('deposite.edit');
                Route::put('update-payment/{deposite}/update', 'update')->name('deposite.update');
                Route::get('view-download-payment/{payment_number}', 'viewDownloadDeposite')->name('deposite.viewDownloadDeposite');
                Route::post('destroy-payment', 'destroy')->name('deposite.destroy');
            });

            //Payment settings
            Route::controller(PaymentSettingsController::class)->group(function() {
                Route::get('payment-settings', 'index')->name('paymentsettings.index');
                Route::post('payment-settings-store', 'store')->name('paymentsettings.store');
                Route::get('get-session-payment-data', 'show')->name('paymentsettings.show');
                Route::post('payment-settings-destroy', 'destroy')->name('paymentsettings.destroy');
                // Payment Due
                Route::get('payment-due', 'paymentdue')->name('deposite.paymentdue');
                Route::post('payment-due-list', 'show_due_payment')->name('deposite.show_due_payment');
            });

            // Payroll settings 
            Route::controller(PayrollSettingsController::class)->group(function() {
                Route::get('payroll-settings', 'index')->name('payroll.index');
                Route::post('payroll-settings-store', 'store')->name('payroll.store');
                Route::get('get-payroll-settings', 'show')->name('payroll.show');
                Route::get('payroll-data', 'create')->name('payroll.create');
                Route::post('payroll-settings-deleted', 'destroy')->name('payroll.destroy');
            });

            // Student Fee settings 
            Route::controller(StudentFeeSettingsController::class)->group(function() {
                Route::get('student-fee-settings', 'index')->name('studentFeeSettings.index');
                Route::post('student-fee-store', 'store')->name('studentFeeSettings.store');
                Route::get('get-student-fee-settings', 'show')->name('studentFeeSettings.show');
                Route::post('student-fee-settings-destroy', 'destroy')->name('studentFeeSettings.destroy');
            });

            // Attendance Management
            Route::controller(AttendanceController::class)->group(function() {
                Route::get('take-class-attendance', 'takeClassAttendance')->name('attendance.takeClassAttendance');
                
                Route::get('class-attendance', 'classAttendance')->name('attendance.classAttendance');
                Route::post('class-attendance-data', 'classAttendanceData')->name('attendance.classAttendanceData');
                Route::get('student-attendance', 'studentAttendance')->name('attendance.studentAttendance');
            });
            
            // Website Management
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
        
        //teacher Dashboard
        Route::controller(AdminController::class)->group(function() {
            Route::get('teacher-dashboard', 'teacherDashboard')->name('teacher.dashboard');
            Route::get('logout', 'logout')->name('admin.logout');
        });

        Route::controller(StudentController::class)->group(function() {
            Route::get('students-in-class', 'teacherManageStudent')->name('student.teacherManageStudent');
            Route::post('teacher-manage-students', 'studentsInClass')->name('student.studentsInClass');
        });
        
        Route::controller(AttendanceController::class)->group(function() {
            Route::get('take-attendance', 'index')->name('attendance.index');
            Route::post('give-attendance', 'store')->name('attendance.store');
            Route::get('get-today-attendance', 'create')->name('attendance.create');
            
            Route::get('view-class-attendance', 'show')->name('attendance.show');
            Route::post('today-attendance-data', 'getTodayAttendanceData')->name('attendance.getTodayAttendanceData');
            Route::post('today-attendance-delete', 'destroy')->name('attendance.destroy');
            
            Route::get('view-student-attendance', 'viewStudentAttendance')->name('attendance.viewstudent');
            Route::post('view-student-attendance-list', 'viewStudentList')->name('attendance.viewStudentList');
        });
    });
});