<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    // protected $listen = [
    //     'Illuminate\Mail\Events\MessageSending' => [
    //         'App\Listeners\LogSendingMessage',
    //     ],
    //     'Illuminate\Mail\Events\MessageSent' => [
    //         'App\Listeners\LogSentMessage',
    //     ],
    // ];
    
    /**
    * The event listener mappings for the application.
    *
     * @var array
     */
    protected $listen = [
        UserRegistered::class => [
            SendWelcomeNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
