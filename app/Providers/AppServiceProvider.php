<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Printing;
use App\Models\PrintingComment;
use App\Observers\PostObserver;
use App\Observers\PrintingCommentObserver;
use App\Observers\PrintingObserver;
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
    }
}
