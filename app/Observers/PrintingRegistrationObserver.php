<?php

namespace App\Observers;

use App\Models\PrintingRegistration;

class PrintingRegistrationObserver
{
    /**
     * Handle the printing registration "creating" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function creating(PrintingRegistration $printingRegistration)
    {
        $printingRegistration->user_id = auth()->id();
    }

    /**
     * Handle the printing registration "created" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function created(PrintingRegistration $printingRegistration)
    {
        //
    }

    /**
     * Handle the printing registration "updated" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function updated(PrintingRegistration $printingRegistration)
    {
        //
    }

    /**
     * Handle the printing registration "deleted" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function deleted(PrintingRegistration $printingRegistration)
    {
        //
    }

    /**
     * Handle the printing registration "restored" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function restored(PrintingRegistration $printingRegistration)
    {
        //
    }

    /**
     * Handle the printing registration "force deleted" event.
     *
     * @param \App\Models\PrintingRegistration $printingRegistration
     * @return void
     */
    public function forceDeleted(PrintingRegistration $printingRegistration)
    {
        //
    }
}
