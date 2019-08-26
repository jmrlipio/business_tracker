<?php

namespace App\Listeners;

// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SalesSynchronizationMail;

class NewSalesSynchronizationListener
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
        //Send Email here
        dump('fuck');
        //Mail::to('test@test.com')->send(new SalesSynchronizationMail());
    }
}
