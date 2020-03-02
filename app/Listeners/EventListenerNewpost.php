<?php

namespace App\Listeners;

use App\Log_news;
use App\Events\EventCreateNewPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerNewpost
{
    private $new_log;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Log_news $new_log)
    {
        $this->new_log = $new_log;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventCreateNewPost $event)
    {
        $post = $event->post;
            $this->new_log->insert([
                'username' => session()->get('privilages'),
                'event' => 'Created',
                'logs_file' => $post->body
            ]);
    }
}
