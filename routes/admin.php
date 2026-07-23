<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\ActivityLogController;
use App\Http\Controllers\Backend\ApiLogController;
use App\Http\Controllers\Backend\AuthLogController;
use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CacheController;
use App\Http\Controllers\Backend\CacheLockController;
use App\Http\Controllers\Backend\CareerApplicationController;
use App\Http\Controllers\Backend\CareerApplicationStatusController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\CaseStudyCategoryController;
use App\Http\Controllers\Backend\CaseStudyController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DebugLogController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\EmailController;
use App\Http\Controllers\Backend\EmailLogController;
use App\Http\Controllers\Backend\EmailTemplateController;
use App\Http\Controllers\Backend\EnquiryController;
use App\Http\Controllers\Backend\ErrorReportController;
use App\Http\Controllers\Backend\FailedJobController;
use App\Http\Controllers\Backend\FaqCategoryController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FormController;
use App\Http\Controllers\Backend\GoogleReviewController;
use App\Http\Controllers\Backend\WebsiteAuditLeadController;
use App\Http\Controllers\Backend\JobBatchController;
use App\Http\Controllers\Backend\JobController;
use App\Http\Controllers\Backend\MarketingIndustryCategoryController;
use App\Http\Controllers\Backend\MarketingIndustryController;
use App\Http\Controllers\Backend\MarketingPartnerController;
use App\Http\Controllers\Backend\MediaLibraryController;
use App\Http\Controllers\Backend\MediaRelationController;
use App\Http\Controllers\Backend\MediaTempController;
use App\Http\Controllers\Backend\MigrationController;
use App\Http\Controllers\Backend\NewsletterSubscriberController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PageSectionController;
use App\Http\Controllers\Backend\PageTemplateController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PlatformController;
use App\Http\Controllers\Backend\PortfolioCategoryController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\ResumeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\SectionContentController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\ServiceFaqController;
use App\Http\Controllers\Backend\SessionController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\SMTPSettingController;
use App\Http\Controllers\Backend\SystemLogController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\TechnologyCategoryController;
use App\Http\Controllers\Backend\TechnologyController;
use App\Http\Controllers\Backend\TemplateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserPermissionController;
use Illuminate\Support\Facades\Route;

// Redirect Routes
Route::get('/', function () {
    return redirect('/admin/dashboard');
});

// Guest Routes
Route::middleware('admin.guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::get('/forgot', 'forgot')->name('forgot.index');
    Route::post('/login/submit/{guard}', 'loginsubmit')->name('login.submit')->where('guard', 'admin|web');
    Route::post('/forgot/submit', 'forgotsubmit')->name('forgot.submit');
});

// Authenticated Routes
Route::middleware('admin.auth')->group(function () {

    // Self-service Profile / Password Routes
    Route::controller(AuthController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile.index');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::post('/profile/change-password', 'changePassword')->name('profile.change-password');
    });

    // Authentication Logs Routes
    Route::prefix('auth-logs')->name('auth.logs.')->controller(AuthLogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Category Routes
    Route::prefix('departments')->controller(DepartmentController::class)->name('departments.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    Route::prefix('sessions')->controller(SessionController::class)->name('sessions.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Communication Routes

    // Enquiries
    Route::prefix('enquiries')->name('enquiries.')->controller(EnquiryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{uuid}', 'details')->name('details');
        Route::get('/markspam/{uuid}', 'markspam')->name('markspam');
        Route::post('/update-status/{uuid}', 'updatestatus')->name('update-status');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Newsletter Subscribers
    Route::prefix('newsletter-subscribers')->name('newsletter-subscribers.')->controller(NewsletterSubscriberController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{uuid}', 'details')->name('details');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Service Routes
    Route::prefix('services')->name('services.')->group(function () {

        Route::controller(ServiceController::class)->name('')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
            Route::post('/galleryreorder/{uuid}', 'galleryreorder')->name('galleryreorder');
        });

        // Category Routes
        Route::prefix('faqs')->controller(ServiceFaqController::class)->name('faqs.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });

    });

    // Authors Routes
    Route::prefix('authors')->controller(AuthorController::class)->name('authors.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
    });

    // Tags Routes
    Route::prefix('tags')->controller(TagController::class)->name('tags.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Forms Routes
    // Route::prefix('forms')->controller(PageController::class)->name('forms.')->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
    //     Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
    //     Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    //     Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    // });

    // Pages Routes
    Route::prefix('pages')->controller(PageController::class)->name('pages.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{uuid}', 'details')->name('details');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Sections Routes
    Route::prefix('sections')->controller(SectionController::class)->name('sections.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Section Contents Routes
    Route::prefix('section-contents')->controller(SectionContentController::class)->name('section-contents.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Templates Routes
    Route::prefix('templates')->controller(TemplateController::class)->name('templates.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // Marketing Routes
    Route::prefix('marketing')->name('marketing.')->group(function () {

        /* =====================================================
     | INDUSTRY ROUTES
     ===================================================== */
        Route::prefix('industries')->name('industries.')->group(function () {

            Route::controller(MarketingIndustryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
                Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
                Route::post('/reorder', 'reorder')->name('reorder');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
                Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
            });

            /* =====================================================
         | INDUSTRY CATEGORY ROUTES
         ===================================================== */
            Route::prefix('categories')->name('categories.')->controller(MarketingIndustryCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
                Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
                Route::post('/reorder', 'reorder')->name('reorder');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            });
        });

        /* =====================================================
     | PARTNER ROUTES
     ===================================================== */
        Route::prefix('partners')->name('partners.')->controller(MarketingPartnerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });
    });

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {

        // Site Settings Routes
        Route::prefix('/sites')->controller(SiteSettingController::class)->name('sites.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/saveorupdate', 'saveorupdate')->name('saveorupdate');
        });

        // SMTP Settings Routes
        Route::prefix('/smtp')
            ->controller(SMTPSettingController::class)
            ->name('smtp.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
                Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            });

        // Cache Routes
        Route::prefix('/cache')->controller(CacheController::class)->name('cache.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/clear', 'clear')->name('clear');
            });

        // Cache Locks Routes
        Route::prefix('/cache/locks')->controller(CacheLockController::class)->name('cache.locks.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/clear', 'clear')->name('clear');
        });

        // Jobs Routes
        Route::prefix('/jobs')->controller(JobController::class)->name('jobs.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        // Job Batches Routes
        Route::prefix('/jobs/batches')->controller(JobBatchController::class)->name('jobs.batches.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        // Failed Jobs Routes
        Route::prefix('/jobs/failed')->controller(FailedJobController::class)->name('jobs.failed.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/retry/{id}', 'retry')->name('retry');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Migrations Routes
        Route::prefix('/migrations')->controller(MigrationController::class)->name('migrations.')->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });

    // Media Routes
    Route::prefix('media')->name('media.')->group(function () {

        // Temp upload for the global crop-and-upload widget
        Route::post('/temp-upload', [MediaTempController::class, 'store'])
            ->name('temp-upload');

        // Media Library Routes
        Route::prefix('/library')->controller(MediaLibraryController::class)->name('library.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });

        // Media Relations Routes
        Route::prefix('/relations')->controller(MediaRelationController::class)->name('relations.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });
    });

    // Blogs Routes
    Route::prefix('blogs')->name('blogs.')->group(function () {

        Route::controller(BlogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
            Route::post('/galleryreorder/{uuid}', 'galleryreorder')->name('galleryreorder');
        });

        // Blog Category Routes
        Route::prefix('categories')
            ->name('categories.')
            ->controller(BlogCategoryController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
                Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
                Route::post('/reorder', 'reorder')->name('reorder');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            });

        // Comments Routes
        Route::prefix('comments')->controller(BlogCommentController::class)->name('comments.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });
    });

    // Faqs Routes
    Route::prefix('faqs')->name('faqs.')->group(function () {

        Route::controller(FaqController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        // Faq Category Routes
        Route::prefix('categories')
            ->name('categories.')
            ->controller(FaqCategoryController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
                Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
                Route::post('/reorder', 'reorder')->name('reorder');
                Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
                Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            });
    });

    Route::prefix('testimonials')->name('testimonials.')->controller(TestimonialController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
    });

    Route::prefix('google-reviews')->name('google-reviews.')->controller(GoogleReviewController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/sync', 'sync')->name('sync');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    Route::prefix('website-audit-leads')->name('website-audit-leads.')->controller(WebsiteAuditLeadController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/details/{uuid}', 'details')->name('details');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Emails Routes
    Route::prefix('emails')->name('emails.')->group(function () {

        // Emails (Send Emails)
        Route::controller(EmailController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/send', 'send')->name('send');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        });

        // Email Templates
        Route::prefix('templates')->name('templates.')->controller(EmailTemplateController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/preview', 'preview')->name('preview');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        // Email Logs
        Route::prefix('logs')->name('logs.')->controller(EmailLogController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/view/{uuid}', 'view')->name('view');
        });
    });

    // Case Studies Routes
    Route::prefix('casestudies')->name('casestudies.')->group(function () {

        Route::controller(CaseStudyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
            Route::post('/galleryreorder/{uuid}', 'galleryreorder')->name('galleryreorder');
        });

        // Case Study Category Routes
        Route::prefix('categories')->name('categories.')->controller(CaseStudyCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });
    });

    // Careers & HR Routes
    Route::prefix('careers')->name('careers.')->group(function () {

        /*
    |--------------------------------------------------------------------------
    | Careers (Job Openings)
    |--------------------------------------------------------------------------
    */
        Route::controller(CareerController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        /*
    |--------------------------------------------------------------------------
    | Career Applications
    |--------------------------------------------------------------------------
    */
        Route::prefix('applications')->name('applications.')->controller(CareerApplicationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::get('/reject-status', 'rejectStatus')->name('reject-status');
            Route::post('/update-status/{uuid}', 'updateStatus')->name('update-status');
            Route::get('/download-resume/{uuid}', 'downloadresume')->name('downloadresume');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        });

        /*
    |--------------------------------------------------------------------------
    | Application Status Logs
    |--------------------------------------------------------------------------
    */
        Route::prefix('application-status')->name('application-status.')->controller(CareerApplicationStatusController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{applicationUuid}', 'history')->name('history');
        });

        /*
    |--------------------------------------------------------------------------
    | Resumes
    |--------------------------------------------------------------------------
    */
        Route::prefix('resumes')->name('resumes.')->controller(ResumeController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/view/{uuid}', 'view')->name('view');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        });
    });

    // Portfolios Routes
    Route::prefix('portfolios')->name('portfolios.')->group(function () {

        Route::controller(PortfolioController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
            Route::post('/galleryreorder/{uuid}', 'galleryreorder')->name('galleryreorder');
        });

        // Portfolio Category Routes
        Route::prefix('categories')->name('categories.')->controller(PortfolioCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });
    });

    // Skills Routes
    Route::prefix('skills')->controller(SkillController::class)->name('skills.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
    });

    // Technologies Routes
    Route::prefix('technologies')->name('technologies.')->group(function () {

        Route::controller(TechnologyController::class)->name('')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });

        // Category Routes
        Route::prefix('categories')->controller(TechnologyCategoryController::class)->name('categories.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
            Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
        });
    });

    // Pages Routes
    Route::prefix('pages')->name('pages.')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Pages Routes
        |--------------------------------------------------------------------------
        */
        Route::controller(PageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::post('/reorder', 'reorder')->name('reorder');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        /*
        |--------------------------------------------------------------------------
        | Form Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('forms')->name('forms.')->controller(FormController::class)->group(function () {
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::get('/', 'index')->name('index');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        /*
        |--------------------------------------------------------------------------
        | Templates Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('templates')->name('templates.')->controller(PageTemplateController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        /*
        |--------------------------------------------------------------------------
        | Sections Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('sections')->name('sections.')->controller(PageSectionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });
    });

    /*
        |--------------------------------------------------------------------------
        | Platforms
        |--------------------------------------------------------------------------
        */
    Route::prefix('platforms')->name('platforms.')->controller(PlatformController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::post('/reorder', 'reorder')->name('reorder');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        Route::get('/togglefeatured/{uuid}', 'togglefeatured')->name('togglefeatured');
    });

    // Notifications Routes
    Route::prefix('notifications')->name('notifications.')->controller(NotificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/mark-as-read/{uuid}', 'markAsRead')->name('markAsRead');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Activity Logs Routes
    Route::prefix('activity-logs')->name('activity-logs.')->controller(ActivityLogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // System Logs Routes
    Route::prefix('system-logs')->name('system-logs.')->controller(SystemLogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // API Logs Routes
    Route::prefix('api-logs')->name('api-logs.')->controller(ApiLogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Debug Logs Routes
    Route::prefix('debug-logs')->name('debug-logs.')->controller(DebugLogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Error Reports Routes
    Route::prefix('error-reports')->name('error-reports.')->controller(ErrorReportController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/view/{uuid}', 'view')->name('view');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    Route::prefix('roles')->name('roles.')->group(function () {

        Route::controller(RoleController::class)->name('')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        // Category Routes
        Route::prefix('permissions')->name('permissions.')->controller(RolePermissionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });
    });

    Route::prefix('users')->name('users.')->group(function () {

        Route::controller(UserController::class)->name('')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details/{uuid}', 'details')->name('details');
            Route::get('/profile/{uuid}', 'details')->name('profile');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });

        // Category Routes
        Route::prefix('permissions')->name('permissions.')->controller(UserPermissionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
            Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
            Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
            Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
        });
    });

    // Permissions Routes
    Route::prefix('permissions')->name('permissions.')->controller(PermissionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/createoredit/{uuid?}', 'createoredit')->name('createoredit');
        Route::post('/saveorupdate/{uuid?}', 'saveorupdate')->name('saveorupdate');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
        Route::get('/togglestatus/{uuid}', 'togglestatus')->name('togglestatus');
    });

    // User Permissions Routes
    Route::prefix('user-permissions')->name('user-permissions.')->controller(UserPermissionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
    });

    // Sessions Routes
    Route::prefix('sessions')->name('sessions.')->controller(SessionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/destroy/{uuid}', 'destroy')->name('destroy');
    });

    // Logout Routes
    Route::post('/logout/{guard}', [AuthController::class, 'logout'])->name('logout')->where('guard', 'admin|web');
});
