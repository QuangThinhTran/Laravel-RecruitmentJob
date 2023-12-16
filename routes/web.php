<?php

use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\CMS\ContactController;
use App\Http\Controllers\CMS\OAuthController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\CMS\ReportController;
use App\Http\Controllers\CMS\ReviewController;
use App\Http\Controllers\CMS\CompanyController;
use App\Http\Controllers\CMS\TypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//User
Route::prefix('user')->group(function () {
    Route::get('/user-login', [LoginController::class, 'index'])->name('user.login');
    Route::post('/user-login', [LoginController::class, 'handleLogin'])->name('handle.login');

    Route::get('/user-register', [RegisterController::class, 'index'])->name('user.register');
    Route::post('/user-register', [RegisterController::class, 'handleRegister'])->name('handle.register');

    Route::get('/forgot-password', [ForgotController::class, 'index'])->name('forgot.mail.index');
    Route::post('/send-mail-forgot-email', [ForgotController::class, 'sendMailForgot'])->name('send.forgot.mail');
    Route::get('/forgot-password/{email}', [ForgotController::class, 'forgotPassWord'])->name('forgot.password.index');
    Route::post('/forgot-password', [ForgotController::class, 'handleForgot'])->name('handle.forgot');

    Route::post('/update-password', [ResetController::class, 'updatePassword'])->name('password.update');

    Route::get('/applied-post', [UserController::class, 'applied'])->name('user.applied.post');
    Route::get('/un-applied-post', [UserController::class, 'unApplied'])->name('user.un.applied.post');
});

//Profile
Route::prefix('profile')->group(function () {
    Route::get('/{id}', [ProfileController::class, 'userCompany'])->name('profile.user');
    Route::get('/detail/{id}', [ProfileController::class, 'userProfile'])->name('profile.user.detail');
    Route::get('/user-profile/{id}', [ProfileController::class, 'profile'])->name('profile.index');
    Route::post('/user-update', [ProfileController::class, 'handleUpdate'])->name('profile.update');
    Route::post('/user-update-basic', [ProfileController::class, 'handleUpdateBasic'])->name('profile.update.basic');
    Route::post('/user-update-information', [ProfileController::class, 'handleUpdateInfor'])->name('profile.update.information');
    Route::get('/company-profile/{id}', [ProfileController::class, 'profileCompany'])->name('company.profile');
});

//Post
Route::prefix('post')->group(function () {
    Route::get('/list-post', [PostController::class, 'all'])->name('post.all');
    Route::get('/post-detail/{id}', [PostController::class, 'show'])->name('post.detail');
    Route::post('/post-create', [PostController::class, 'store'])->name('post.create');
    Route::get('/post-edit', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post-update', [PostController::class, 'update'])->name('post.update');
    Route::post('/post-delete', [PostController::class, 'delete'])->name('post.delete');
    Route::get('/post-trashed', [PostController::class, 'trashed'])->name('post.trashed');
    Route::post('/post-restore', [PostController::class, 'restore'])->name('post.restore');
    Route::get('/post-status', [PostController::class, 'status'])->name('post.status');
});

//Backend
Route::prefix('search')->group(function () {
    Route::post('/', [BackendController::class, 'searchFilter'])->name('search.layout.filter');
    Route::post('/filter', [BackendController::class, 'searchCompanyFilter'])->name('search.company.filter');
    Route::post('/filter-datetime', [BackendController::class, 'searchFilterDatetime'])->name('search.filter.datetime');
    Route::get('/', [BackendController::class, 'searchAjax'])->name('search.ajax');
    Route::get('/get-post-by-major', [BackendController::class, 'getPostByMajor'])->name('post.major');
    Route::post('/name', [BackendController::class, 'searchUser'])->name('search.user');
});

//Contact
Route::prefix('contact')->group(function () {
    Route::get('', [ContactController::class, 'view'])->name('contact.index');
    Route::get('/contact-detail', [ContactController::class, 'show'])->name('contact.detail');
    Route::post('/contact-create', [ContactController::class, 'store'])->name('contact.create');
    Route::get('/contact-delete', [ContactController::class, 'delete'])->name('contact.delete');
    Route::get('/list-contact-replied', [ContactController::class, 'replied'])->name('contact.replied');
});

//Report
Route::prefix('report')->group(function () {
    Route::get('/list-report', [ReportController::class, 'index'])->name('report.all');
    Route::get('/report-detail', [ReportController::class, 'show'])->name('report.detail');
    Route::get('/image', [ReportController::class, 'image'])->name('report.image');
    Route::post('/report-create', [ReportController::class, 'store'])->name('report.create');
    Route::post('/report-user', [ReportController::class, 'user'])->name('report.user');
    Route::post('/report-review', [ReportController::class, 'review'])->name('report.review');
    Route::get('/report-delete', [ReportController::class, 'delete'])->name('report.delete');
    Route::get('/report-reply', [ReportController::class, 'reply'])->name('report.reply');
    Route::get('/list-report-replied', [ReportController::class, 'replied'])->name('report.replied');
    Route::get('/report-detail-review', [ReportController::class, 'detail'])->name('report.detail.review');
});

//Review
Route::prefix('review')->group(function () {
    Route::get('/list-review', [ReviewController::class, 'index'])->name('review.view');
    Route::post('/review-create', [ReviewController::class, 'store'])->name('review.create');
    Route::post('/review-update', [ReviewController::class, 'update'])->name('review.update');
    Route::post('/review-delete', [ReviewController::class, 'delete'])->name('review.delete');
});

//Type
Route::prefix('type')->group(function (){
    Route::post('/type-create',[TypeController::class,'store'])->name('type.create');
    Route::post('/type-update',[TypeController::class,'update'])->name('type.update');
    Route::post('/type-delete',[TypeController::class,'delete'])->name('type.delete');
});

//Dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'authorize'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/register-admin', [DashboardController::class, 'register'])->name('dashboard.register.view');
    Route::get('/admin/admin-profile/{id}', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/admin/user-profile/{id}', [DashboardController::class, 'profileUser'])->name('dashboard.profile.user');
    Route::get('/account', [DashboardController::class, 'account'])->name('dashboard.account');
    Route::get('/contact', [DashboardController::class, 'contact'])->name('dashboard.contact');
    Route::get('/report', [DashboardController::class, 'report'])->name('dashboard.report');
    Route::get('/information', [DashboardController::class, 'information'])->name('dashboard.information');
    Route::get('/history', [DashboardController::class, 'history'])->name('dashboard.history');
});

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'authorize'], function () {
    Route::post('/approved_post', [AdminController::class, 'approved'])->name('admin.approved.post');
    Route::post('/delete-user', [AdminController::class, 'deleteUserByAdmin'])->name('admin.delete.user');
    Route::post('/restore-user', [AdminController::class, 'restoreUserByAdmin'])->name('admin.restore.user');
    Route::post('/replied-contact', [AdminController::class, 'repliedContact'])->name('admin.replied.contact');
    Route::post('/replied-report', [AdminController::class, 'repliedReport'])->name('admin.replied.report');
    Route::post('/replied-report-user', [AdminController::class, 'repliedReportUser'])->name('admin.replied.report.user');
    Route::post('/replied-report-review', [AdminController::class, 'repliedReportReview'])->name('admin.replied.report.review');
});

//Company
Route::group(['prefix' => 'company'], function () {
    Route::get('/index', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/candidate', [CompanyController::class, 'candidate'])->name('company.candidate');
    Route::get('/review', [CompanyController::class, 'review'])->name('company.review');
    Route::get('/replied', [CompanyController::class, 'review'])->name('company.replied');
    Route::get('/post-create', [CompanyController::class, 'post'])->name('company.post.create');
    Route::post('/update-profile', [CompanyController::class, 'update'])->name('company.update');
    Route::post('/user-applied-post', [CompanyController::class, 'applied'])->name('company.applied.post');
    Route::get('/company-ticket-replied', [CompanyController::class, 'ticket'])->name('company.ticket.replied');
    Route::get('/delete-ticket-replied', [CompanyController::class, 'deleteTicket'])->name('company.ticket.delete');
    Route::post('/contact-create', [CompanyController::class, 'contactCreate'])->name('company.contact.create');
    Route::get('/restore-post', [CompanyController::class, 'history'])->name('company.history');
    Route::get('/storage-post', [CompanyController::class, 'storage'])->name('company.storage');
});

//Social
Route::get('/login-google/{provider}', [OAuthController::class, 'redirect_Google'])->name('login.google');
Route::get('/callback/{provider}', [OAuthController::class, 'callback_Google'])->name('callback.google');

Route::get('/login-linkedin/{provider}', [OAuthController::class, 'redirect_Linkedin'])->name('login.linkedin');
Route::get('/callback/{provider}', [OAuthController::class, 'callback_Linkedin'])->name('callback.linkedin');

//Backend
Route::group(['prefix' => 'backend'], function () {
    Route::get('/email-delete-post', [BackendController::class, 'deletePostMail'])->name('mail.delete.post');
    Route::get('/email-restore-post', [BackendController::class, 'restorePostMail'])->name('mail.restore.post');
    Route::get('/email-delete-user', [BackendController::class, 'deleteUserMail'])->name('mail.delete.user');
    Route::get('/email-restore-user', [BackendController::class, 'restoreUserMail'])->name('mail.restore.user');

    Route::get('/user', [BackendController::class, 'user'])->name('backend.user');
    Route::get('/post', [BackendController::class, 'post'])->name('backend.post');
    Route::get('/ticket', [BackendController::class, 'ticket'])->name('backend.ticket');
    Route::get('/information', [BackendController::class, 'information'])->name('backend.information');
    Route::post('/filter-datetime', [BackendController::class, 'searchHistory'])->name('backend.filter.datetime');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/error', [HomeController::class, 'notFound'])->name('not.found');

//Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
