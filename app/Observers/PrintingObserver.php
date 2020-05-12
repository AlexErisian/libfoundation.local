<?php

namespace App\Observers;

use App\Models\Printing;
use Str;

class PrintingObserver
{
    /**
     * Handle the printing "creating" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function creating(Printing $printing)
    {
        $this->setSlug($printing);
    }

    /**
     * Handle the printing "created" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function created(Printing $printing)
    {
        //
    }

    /**
     * Handle the printing "updating" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function updating(Printing $printing)
    {
        $this->setSlug($printing);
    }

    /**
     * Handle the printing "updated" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function updated(Printing $printing)
    {
        //
    }

    /**
     * Handle the printing "deleted" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function deleted(Printing $printing)
    {
        //
    }

    /**
     * Handle the printing "restored" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function restored(Printing $printing)
    {
        //
    }

    /**
     * Handle the printing "force deleted" event.
     *
     * @param  \App\Models\Printing  $printing
     * @return void
     */
    public function forceDeleted(Printing $printing)
    {
        //
    }

    private function setSlug(Printing $printing)
    {
        if ($printing->slug != Str::slug($printing->title)) {
            $printing->slug = Str::slug($printing->title);
        }
    }
}
