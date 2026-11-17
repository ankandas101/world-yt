<?php

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginRegisterController;

Route::group( [],function () {

    //Without auth

    //Author page
    Route::Get('/author/{username}',[FrontendController::class,'authorPage'])->name("author");
    //Header
    Route::get('/search', [FrontendController::class,'blogSearch'])->name('blog_search');

    //Home page
    Route::get('/', [FrontendController::class, 'homePage'])->name('home');
    Route::get('/home-page/{section}/{slug}', [FrontendController::class, 'homePageSections']);

    //Blog page
    Route::get('blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog_detail');

    //Category page
    Route::get('category/{cat_slug}', [FrontendController::class, 'catSubcatWiseBlog'])->name('cat_subcat_wise_blog');

    //Contact page
    Route::get('contact-us', [FrontendController::class, 'contactUsPage'])->name('contact_us');
    Route::post('contact-us/post', [FrontendController::class, 'contactUsPost'])->name('contact_us.post');

    //Privacy Policy page
    Route::get('privacy-policy', [FrontendController::class, 'privacyPolicyPage'])->name('privacy_policy');
    Route::get('write-for-us', [FrontendController::class, 'writeForUs'])->name('write_for_us');

    //about us page
    Route::get('about-us', [FrontendController::class, 'aboutUsPage'])->name('about_us');

    // Login routes
    Route::get('/login', [LoginRegisterController::class, 'loginPage'])->name('login');
    Route::post('/login/request-otp', [LoginRegisterController::class, 'requestOtp'])->name('login.request-otp');
    Route::post('/login', [LoginRegisterController::class, 'loginAuthenticate'])->name('login.authenticate');
    Route::get('/register', [LoginRegisterController::class, 'registerPage'])->name('register');
    Route::post('/register', [LoginRegisterController::class, 'registerAuthenticate'])->name('register.authenticate');
    Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [LoginRegisterController::class, 'forgotPasswordPage'])->name('forgot-password');
    Route::post('/forgot-password', [LoginRegisterController::class, 'forgotPasswordAuthenticate'])->name('forgot-password.authenticate');

    //ajax
    Route::get('/recent-blogs', [FrontendController::class, 'recentBlogs'])->name('recent_blog_paginate');

    //Backend
    Route::post('/summernote/image/upload', [BackendController::class, 'summernoteImageUpload'])->name('summernote.image.upload');
    //With auth
    // Route::middleware(['auth'])->name('frontend.')->group(function () {
    // });

    Route::fallback(function () {

        return response()->view('errors.404-custom', [], 404);
    });


});


