<?php

namespace App\Observers;

use App\Models\LibraryService;

class LibraryServiceObserver
{
    /**
     * Handle the library service "creating" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function creating(LibraryService $libraryService)
    {
        $libraryService->user_id = auth()->id();
    }

    /**
     * Handle the library service "created" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function created(LibraryService $libraryService)
    {
        //
    }

    /**
     * Handle the library service "updating" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function updating(LibraryService $libraryService)
    {
        $libraryService->user_id = auth()->id();
    }

    /**
     * Handle the library service "updated" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function updated(LibraryService $libraryService)
    {
        //
    }

    /**
     * Handle the library service "deleted" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function deleted(LibraryService $libraryService)
    {
        //
    }

    /**
     * Handle the library service "restored" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function restored(LibraryService $libraryService)
    {
        //
    }

    /**
     * Handle the library service "force deleted" event.
     *
     * @param  \App\Models\LibraryService  $libraryService
     * @return void
     */
    public function forceDeleted(LibraryService $libraryService)
    {
        //
    }
}
