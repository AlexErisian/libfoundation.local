<?php

namespace App\Observers;

use App\Models\Bookshelf;

class BookshelfObserver
{
    /**
     * Handle the bookshelf "created" event.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return void
     */
    public function created(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Handle the bookshelf "updated" event.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return void
     */
    public function updated(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Handle the bookshelf "deleted" event.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return void
     */
    public function deleted(Bookshelf $bookshelf)
    {
        $bookshelf->printingWritingOffs()->delete();
        $bookshelf->printingRegistrations()->delete();
        $bookshelf->libraryServices()->delete();
    }

    /**
     * Handle the bookshelf "restored" event.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return void
     */
    public function restored(Bookshelf $bookshelf)
    {
        //
    }

    /**
     * Handle the bookshelf "force deleted" event.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return void
     */
    public function forceDeleted(Bookshelf $bookshelf)
    {
        //
    }
}
