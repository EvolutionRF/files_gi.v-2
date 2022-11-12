<?php

namespace App\Providers;

use App\Events\RequestAccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRequestAccessNotification
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
     * @param  \App\Events\RequestAccess  $event
     * @return void
     */
    public function handle(RequestAccess $event)
    {
        //
    }
}
