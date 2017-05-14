<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Note;
use Illuminate\Support\Facades\Auth;

class NotesSubscriber
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
     * @param $events
     */
    public function subscribe($events) {

        $events->listen(
            'App\Events\RequestCreate',
            'App\Listeners\NotesSubscriber@registerNote'
        );

        $events->listen(
            'App\Events\PaymentRegister',
            'App\Listeners\NotesSubscriber@registerNote'
        );

        $events->listen(
            'App\Events\PaymentApprovedEvent',
            'App\Listeners\NotesSubscriber@registerNote'
        );
    }

    /**
     * @param $event
     * @return bool
     */
    public function registerNote($event) {

        $note = new Note();
        $note->content = $event->content;
        $note->user_id = Auth::user()->id;
        $note->source = $event->source;
        $note->route_admin = $event->route_admin;
        $note->route_user = $event->route_user;
        $note->to_user = $event->to_user;
        $note->save();
    }

}
