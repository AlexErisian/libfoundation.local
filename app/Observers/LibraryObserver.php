<?php

namespace App\Observers;

use App\Models\Library;

class LibraryObserver
{
    /**
     * Handle the library "created" event.
     *
     * @param  \App\Models\Library  $library
     * @return void
     */
    public function created(Library $library)
    {
        //
    }

    /**
     * Handle the library "updated" event.
     *
     * @param  \App\Models\Library  $library
     * @return void
     */
    public function updated(Library $library)
    {
        //
    }

    /**
     * Handle the library "deleted" event.
     *
     * @param  \App\Models\Library  $library
     * @return void
     */
    public function deleted(Library $library)
    {
        $library->printingWritingOffs()->delete();
        $library->printingRegistrations()->delete();
        $library->libraryServices()->delete();
        $library->bookshelves()->delete();
    }

    /**
     * Handle the library "restored" event.
     *
     * @param  \App\Models\Library  $library
     * @return void
     */
    public function restored(Library $library)
    {
        //
    }

    /**
     * Handle the library "force deleted" event.
     *
     * @param  \App\Models\Library  $library
     * @return void
     */
    public function forceDeleted(Library $library)
    {
        //
    }
}
