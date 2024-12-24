<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleStateUpdate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $payload = json_decode($event->message);

        $data = $payload->data;

        if ($payload->event !== "client-CheckboxUpdated") {
            return;
        }

        //update in redis db
        \Log::info("updated in redis db");
    }
}
