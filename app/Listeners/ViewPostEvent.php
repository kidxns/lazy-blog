<?php

namespace App\Listeners;

use App\Events\ViewPostHandler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ViewPostEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ViewPostHandle  $event
     * @return void
     */
    public function handle(ViewPostHandler $event)
    {
        // $event->increment('view_count');
    }
}
