<?php

namespace App\Listeners;

use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Operation::create([
            "type" => "update",
            "table" => "books",
            "user_id" => Auth::id(),
        ]);
    }
}
