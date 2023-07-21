<?php

namespace App\Observers;

use App\Models\Support;

class SupportObserver
{
    /**
     * Handle the Support "created" event.
     */
    public function creating(Support $support): void
    {
        $support->user_id = auth()->user()->id;
    }
}