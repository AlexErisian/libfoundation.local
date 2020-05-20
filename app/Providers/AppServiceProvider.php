<?php

namespace App\Providers;

use App\Models\LibraryService;
use App\Models\Post;
use App\Models\Printing;
use App\Models\PrintingComment;
use App\Models\PrintingRegistration;
use App\Models\PrintingWritingOff;
use App\Observers\LibraryServiceObserver;
use App\Observers\PostObserver;
use App\Observers\PrintingCommentObserver;
use App\Observers\PrintingObserver;
use App\Observers\PrintingRegistrationObserver;
use App\Observers\PrintingWritingOffObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Printing::observe(PrintingObserver::class);
        PrintingComment::observe(PrintingCommentObserver::class);
        LibraryService::observe(LibraryServiceObserver::class);
        PrintingRegistration::observe(PrintingRegistrationObserver::class);
        PrintingWritingOff::observe(PrintingWritingOffObserver::class);
    }
}
