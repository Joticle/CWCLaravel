<?php

use App\Http\Controllers\Backoffice\AdminAuthController;
use App\Http\Controllers\Backoffice\AdminController;
use App\Http\Controllers\Backoffice\ContentTypeController;
use App\Http\Controllers\Backoffice\CourseController;
use App\Http\Controllers\Backoffice\CourseMaterialController;
use App\Http\Controllers\Backoffice\CourseModuleController;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'web'], function(){
    Route::get('/', [FrontEndController::class, 'index'])->name('index');
    Route::get('/home', [FrontEndController::class, 'index'])->name('home');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('logout', [FrontEndController::class, 'logout'])->name('logout');

        Route::group(['middleware' => 'check.user.status'], function(){
            Route::get('/courses', [FrontEndController::class, 'courses'])->name('courses');

            /*Profile*/
            Route::get('profile', [HomeController::class, 'profile'])->name('profile');
            Route::post('profile', [HomeController::class, 'updateProfile'])->name('updateProfile');
            Route::post('password-update', [HomeController::class, 'updateProfilePassword'])->name('updateProfilePassword');
        });
    });

    Route::group(['prefix' => 'cwcadmin','as' => 'admin.'], function(){
        Route::get('/', [AdminAuthController::class, 'index'])->name('index');
        Route::get('/login', [AdminAuthController::class, 'login'])->name('login');

        Route::group(['middleware' => 'auth'], function(){
            Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
            Route::group(['middleware' => 'check.admin.status'], function(){

                Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

                /*Courses*/
                Route::group(['prefix' => 'course','as' => 'course.'], function(){
                    Route::get('/list', [CourseController::class, 'index'])->name('list');
                    Route::get('/create', [CourseController::class, 'add'])->name('add');
                    Route::post('/create', [CourseController::class, 'create'])->name('add');
                    Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
                    Route::post('/edit/{id}', [CourseController::class, 'update'])->name('edit');
                    Route::get('/delete/{id}', [CourseController::class, 'delete'])->name('delete');
                    Route::get('/search', [CourseController::class, 'search'])->name('search');
                });


                /*Course Modules*/
                Route::group(['prefix' => 'course-module','as' => 'course.module.'], function(){
                    Route::get('/{course_id?}', [CourseModuleController::class, 'index'])->name('list');
                    Route::post('/{course_id}', [CourseModuleController::class, 'create'])->name('add');
                    Route::post('/sort/all', [CourseModuleController::class, 'sort'])->name('sort');
                    Route::get('/edit/{id?}', [CourseModuleController::class, 'edit'])->name('edit');
                    Route::post('/edit/{id?}', [CourseModuleController::class, 'update'])->name('edit');
                    Route::get('/delete/{id}', [CourseModuleController::class, 'delete'])->name('delete');
                });

                /*Course Module Content*/
                Route::group(['prefix' => 'course-material','as' => 'course.content.'], function(){
                    Route::get('/{module_id?}', [CourseMaterialController::class, 'index'])->name('list');
                    Route::post('/{module_id}', [CourseMaterialController::class, 'create'])->name('add');
                    Route::post('/sort/all', [CourseMaterialController::class, 'sort'])->name('sort');
                    Route::get('/delete/{id}', [CourseMaterialController::class, 'delete'])->name('delete');
                });

                /*Course Content Types*/
                Route::group(['prefix' => 'content-types','as' => 'content-type.'], function(){
                    Route::get('/list', [ContentTypeController::class, 'index'])->name('list');
                    Route::get('/create', [ContentTypeController::class, 'add'])->name('add');
                    Route::post('/create', [ContentTypeController::class, 'create'])->name('add');
                    Route::get('/edit/{id}', [ContentTypeController::class, 'edit'])->name('edit');
                    Route::post('/edit/{id}', [ContentTypeController::class, 'update'])->name('edit');
                    Route::get('/delete/{id}', [ContentTypeController::class, 'delete'])->name('delete');
                });

            });
        });
    });
});
Auth::routes();