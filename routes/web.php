<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LatestNewsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Web\NewsLetterController;

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

Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('about-sun-security', [HomeController::class, 'aboutUs'])->name('site.about');
Route::get('our-services', [HomeController::class, 'services'])->name('site.services');
Route::get('security-tips', [HomeController::class, 'securityTips'])->name('site.tips');
Route::get('gallery', [HomeController::class, 'gallery'])->name('site.gallery');
Route::get('career/{id?}', [HomeController::class, 'career'])->name('site.career');
Route::post('career-apply', [HomeController::class, 'applyJob'])->name('site.career.apply');
Route::get('job-apply-form/{id}', [HomeController::class, 'jobApplyForm'])->name('site.job.apply');
Route::post('submit-job-apply-form', [HomeController::class, 'jobApplyFormSubmit'])->name('site.job.apply.submit');
Route::match(['get', 'post'], 'contact', [HomeController::class, 'contact'])->name('site.contact');
Route::get('blog/{id?}', [HomeController::class, 'blog'])->name('site.blog');
Route::post('newsletter-subscribe', [NewsLetterController::class, 'index'])->name('site.newsletter');

Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('admin.login');

    // Authenticated routes
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
        Route::post('update-password', [AuthController::class, 'updatePassword'])->name('admin.update.password');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        // Notification
        Route::prefix('notification')->group(function () {
            Route::post('add-notification', [DashboardController::class, 'addNotification'])->name('admin.notification.add');
            Route::post('delete-notification', [DashboardController::class, 'deleteNotification'])->name('admin.notification.delete');
        });

        // Carousel
        Route::prefix('carousel')->group(function () {
            Route::get('view', [CarouselController::class, 'index'])->name('admin.carousel.index');
            Route::post('add-new-carousel-image', [CarouselController::class, 'addCarouselImage'])->name('admin.carousel.add');
            Route::post('update-carousel-image', [CarouselController::class, 'updateCarouselImage'])->name('admin.carousel.update');
            Route::post('delete-carousel-image', [CarouselController::class, 'deleteCarouselImage'])->name('admin.carousel.delete');
        });

        // Gallery
        Route::prefix('gallery')->group(function () {
            Route::get('view', [GalleryController::class, 'index'])->name('admin.gallery.index');
            Route::post('add-new-gallery-image', [GalleryController::class, 'addGalleryImage'])->name('admin.gallery.add');
            Route::post('delete-gallery-image', [GalleryController::class, 'deleteGalleryImage'])->name('admin.gallery.delete');
        });

        // Services
        Route::prefix('services')->group(function () {
            Route::get('view', [ServiceController::class, 'index'])->name('admin.services.index');
            Route::post('upload-service-image', [ServiceController::class, 'uploadImage'])->name('admin.services.upload.image');
        });

        // Latest news
        Route::prefix('latest-news')->group(function () {
            Route::get('view', [LatestNewsController::class, 'index'])->name('admin.latestnews.index');
            Route::post('view', [LatestNewsController::class, 'addLatestNews'])->name('admin.latestnews.add');
            Route::post('get-latest-news-details', [LatestNewsController::class, 'getLatestNewsDetails'])->name('admin.get.latestnews.details');
            Route::post('update-latest-news-details', [LatestNewsController::class, 'updateLatestNewsDetails'])->name('admin.update.latestnews.details');
            Route::post('delete-latest-news', [LatestNewsController::class, 'deleteLatestNews'])->name('admin.delete.latestnews');
        });

        // Testimonial
        Route::prefix('testimonial')->group(function () {
            Route::get('view', [TestimonialController::class, 'index'])->name('admin.testimonial.index');
            Route::post('add-testimonial', [TestimonialController::class, 'addTestimonial'])->name('admin.testimonial.add');
            Route::post('delete-testimonial', [TestimonialController::class, 'deleteTestimonial'])->name('admin.testimonial.delete');
        });

        // Blogs
        Route::prefix('blog')->group(function () {
            Route::get('view', [BlogController::class, 'index'])->name('admin.blog.index');
            Route::match(['get', 'post'], 'add-blog', [BlogController::class, 'addBlog'])->name('admin.blog.add');
            Route::match(['get', 'post'], 'edit-blog/{id}', [BlogController::class, 'editBlog'])->name('admin.blog.edit');
            Route::post('update-featured-image', [BlogController::class, 'updateImage'])->name('admin.blog.image.update');
            Route::post('delete', [BlogController::class, 'deleteBlog'])->name('admin.blog.delete');
        });

        // Career
        Route::prefix('career')->group(function () {
            Route::get('view', [CareerController::class, 'index'])->name('admin.career.index');
            Route::match(['get', 'post'], 'add-career', [CareerController::class, 'addCareer'])->name('admin.career.add');
            Route::match(['get', 'post'], 'edit-career/{id}', [CareerController::class, 'editCareer'])->name('admin.career.edit');
            Route::post('career-change-status', [CareerController::class, 'changeStatus'])->name('admin.career.change.status');
            Route::post('delete', [CareerController::class, 'deleteCareer'])->name('admin.career.delete');
        });
    });
});
