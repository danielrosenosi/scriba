<?php

namespace App\Observers;

use App\Models\ReplySupport;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "created" event.
     */
    public function creating(ReplySupport $reply): void
    {
        $reply->user_id = auth()->id();
    }
}
