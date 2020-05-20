<?php

namespace App\Observers;

use App\Models\PrintingWritingOff;

class PrintingWritingOffObserver
{
    /**
     * Handle the printing registration "creating" event.
     *
     * @param \App\Models\PrintingWritingOff $printingWritingOff
     * @return void
     */
    public function creating(PrintingWritingOff $printingWritingOff)
    {
        $printingWritingOff->user_id = auth()->id();
    }

    /**
     * Handle the printing writing off "created" event.
     *
     * @param  \App\Models\PrintingWritingOff  $printingWritingOff
     * @return void
     */
    public function created(PrintingWritingOff $printingWritingOff)
    {
        //
    }

    /**
     * Handle the printing writing off "updated" event.
     *
     * @param  \App\Models\PrintingWritingOff  $printingWritingOff
     * @return void
     */
    public function updated(PrintingWritingOff $printingWritingOff)
    {
        //
    }

    /**
     * Handle the printing writing off "deleted" event.
     *
     * @param  \App\Models\PrintingWritingOff  $printingWritingOff
     * @return void
     */
    public function deleted(PrintingWritingOff $printingWritingOff)
    {
        //
    }

    /**
     * Handle the printing writing off "restored" event.
     *
     * @param  \App\Models\PrintingWritingOff  $printingWritingOff
     * @return void
     */
    public function restored(PrintingWritingOff $printingWritingOff)
    {
        //
    }

    /**
     * Handle the printing writing off "force deleted" event.
     *
     * @param  \App\Models\PrintingWritingOff  $printingWritingOff
     * @return void
     */
    public function forceDeleted(PrintingWritingOff $printingWritingOff)
    {
        //
    }
}
