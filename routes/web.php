<?php

use App\Mail\TestEmail;
use App\Models\Article;
use App\Http\Controllers\userInfo;
use App\Http\Middleware\isQuizDone;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemandbepemilikController;
use App\Http\Controllers\pemilikController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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



Route::get('/', function () {
    return view('welcome');
})->name('home');













Route::middleware(['auth'])->group(function () {
    Route::put('/updatepassword', [userInfo::class, 'changepassword'])->name('updatePassword');
Route::delete('/profile', [userInfo::class, 'destroy'])->name('profile.destroy');
// user routes
Route::middleware(['isUser'])->group(function () {
// Route::get('/quiz', function() { return view('user.quiz');})->name('quiz');
// Route::post('/quizend', [userInfo::class, 'quizend'])->name('quizzdone');
// Route::get('/dashboard',[userInfo::class, 'Dashboarding'])->name('dashboard');
Route::get('/dashboard/profile', function() { return view('user.profile'); })->name('user.profile');
Route::get('/dashboard', [userInfo::class , 'index'])->name('dashboard');
Route::get('/dashboard/lomba', [CourseController::class , 'index'])->name('searchLomba');
Route::get('/profile', [userInfo::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [userInfo::class, 'update'])->name('profile.update');
Route::get('/dashboard/course', [CourseController::class, 'search'])->name('user.searchcourse');
Route::get('/dashboard/pemiliks',[pemilikController::class, 'index'])->name('searchPemiliks');
Route::get('/dashboard/pemilik/{id}',[pemilikController::class, 'show'])->name('showapemilik');
Route::post('/dashboard/pemilik/book',[pemilikController::class, 'store'])->name('booking');
Route::post('/dashboard/pemilik/search',[pemilikController::class, 'search'])->name('searchingfoapemilik');
Route::get('/dashboard/course/{id}',[CourseController::class, 'show'])->name('viewCourse');
Route::post('/dashboard/jadiPemilik',[DemandbepemilikController::class, 'store'])->name('jadiPemilik');
Route::get('/dashboard/jadiPemilik',[DemandbepemilikController::class, 'index'])->name('jadiPemilikindex');
Route::post('/dashboard/addcpmment', [CommentController::class ,'store'])->name('addcomment');
Route::post('/dashboard/deletecomment/}', [CommentController::class ,'deleteComment'])->name('deletecomment');
});
// admin routes
Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin',[adminController::class, 'index'])->name('acceptpemilikh');
    Route::get('/admin/pemiliks',[adminController::class, 'acceptpemilik'])->name('acceptpemiliking');
    Route::post('/admin/rejectpemilik',[adminController::class, 'rejectpemilik'])->name('rejectpemilik');
    Route::post('/admin/acceptpemilik',[adminController::class, 'acceptandemailing'])->name('acceptpemilik');
    Route::get('/admin/allpemiliks',[adminController::class, 'showallpemiliks'])->name('showpemilik');
    Route::get('/admin/pemiliks/{id}',[adminController::class, 'destroy'])->name('deletepemilik');
    Route::get('/admin/courses',[adminController::class, 'showCourses'])->name('showCourses');
    Route::get('/admin/course/{id}',[adminController::class, 'deleteCourse'])->name('deleteCourse');

});


// pemilik routes
Route::middleware(['isPemilik'])->group(function () {
    Route::get('/pemilik',[pemilikController::class, 'dashboard'])->name('dashboard.pemilik');
    Route::get('/pemilik/accept/{id}',[pemilikController::class, 'acceptBooking'])->name('accept');
    Route::get('/pemilik/reject/{id}',[pemilikController::class, 'rejectBooking'])->name('reject');
    Route::get('/pemilik/addcourse',[pemilikController::class, 'addcourse'])->name('addcourse');
    Route::get('/pemilik/mycourses',[pemilikController::class, 'mycourses'])->name('mycourses');
    Route::post('/pemilik/addcourse',[pemilikController::class, 'addacourse'])->name('storecourse');
    Route::get('/pemilik/mycourses/{id}',[pemilikController::class, 'deletecourse'])->name('deletecourse');
    Route::post('/pemilik/mycourses/edit',[pemilikController::class, 'editcourse'])->name('editcourse');
    Route::get('/pemilik/editprofile',[pemilikController::class, 'editpemilik'])->name('edittheprofile');
    Route::post('/pemilik/editprofile',[pemilikController::class, 'updatepemilik'])->name('updatepemilik');
    // update route
    Route::post('/pemilik/mycourses/update',[pemilikController::class, 'updatecourse'])->name('updatecourse');



});
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// route::get('show/{id}', [FoodController::class, 'showw'])->name('showw');
});

// admin routes
Route::get('/admin/pemiliks', [adminController::class, 'redirectacceptpemilikview'])->name('admin.pemiliks');

require __DIR__.'/auth.php';
