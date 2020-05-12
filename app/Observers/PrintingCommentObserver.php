<?php

namespace App\Observers;

use App\Models\PrintingComment;

class PrintingCommentObserver
{
    /**
     * Handle the printing comment "creating" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function creating(PrintingComment $printingComment)
    {
        $this->setUserId($printingComment);
    }

    /**
     * Handle the printing comment "created" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function created(PrintingComment $printingComment)
    {
        //
    }

    /**
     * Handle the printing comment "updated" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function updated(PrintingComment $printingComment)
    {
        //
    }

    /**
     * Handle the printing comment "deleted" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function deleted(PrintingComment $printingComment)
    {
        //
    }

    /**
     * Handle the printing comment "restored" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function restored(PrintingComment $printingComment)
    {
        //
    }

    /**
     * Handle the printing comment "force deleted" event.
     *
     * @param \App\Models\PrintingComment $printingComment
     * @return void
     */
    public function forceDeleted(PrintingComment $printingComment)
    {
        //
    }

    private function setUserId(PrintingComment $printingComment)
    {
        if(empty($printingComment->user_id))
        {
            $printingComment->user_id = auth()->id();
        }
    }
}
