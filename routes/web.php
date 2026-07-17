<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\AllianceController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\CareerController;
use App\Http\Controllers\Front\CaseStudyController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\NewsletterController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\HireMeController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\IndustryController;
use App\Http\Controllers\Front\LegalController;
use App\Http\Controllers\Front\PortfolioController;
use App\Http\Controllers\Front\PricingController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\TechStackController;
use App\Http\Controllers\Front\TestimonialController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| BACKEND ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function(){
    return require_once base_path('./routes/admin.php');
});

// Named exactly "password.reset" / "password.update" because Laravel's
// default ResetPassword notification builds its mail link from those
// route names — renaming them breaks the emailed reset link.
Route::prefix('admin')->middleware('admin.guest')->group(function () {
    Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');
});


Route::name('front.')->group(function () {
    /* ================= HOME ================= */
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    /* ================= ABOUT ================= */
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    /* ================= CONTACT ================= */
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

    /* ================= SERVICES ================= */
    Route::prefix('services')->controller(ServiceController::class)->name('services.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= PORTFOLIOS ================= */
    Route::prefix('portfolios')->controller(PortfolioController::class)->name('portfolios.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= INDUSTRIES ================= */
    Route::prefix('industries')->controller(IndustryController::class)->name('industries.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= BLOG ================= */
    Route::prefix('blog')->controller(BlogController::class)->name('blog.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= CASE STUDIES ================= */
    Route::prefix('case-studies')->controller(CaseStudyController::class)->name('casestudies.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= CAREER ================= */
    Route::prefix('career')->controller(CareerController::class)->name('career.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{slug}/apply', 'apply')->name('apply');
        Route::get('/{slug}', 'details')->name('details');
    });

    /* ================= TESTIMONIALS ================= */
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

    /* ================= TECH STACK ================= */
    Route::get('/tech-stack', [TechStackController::class, 'index'])->name('techstack.index');

    /* ================= HIRE ME ================= */
    Route::get('/hire-me', [HireMeController::class, 'index'])->name('hireme.index');

    /* ================= ALLIANCES ================= */
    Route::get('/alliances', [AllianceController::class, 'index'])->name('alliances.index');

    /* ================= PRICING ================= */
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');

    /* ================= FAQ ================= */
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

    /* ================= LEGAL ================= */
    Route::get('/legal/policy', [LegalController::class, 'privacy'])->name('legal.privacy');
    Route::get('/legal/terms', [LegalController::class, 'terms'])->name('legal.terms');
});

Route::fallback(function () {
    return response()->view('front.errors.404', [], 404);
});
