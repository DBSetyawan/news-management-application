<?php

namespace App\Listeners;

use App\Log_news;
use Illuminate\Http\Request;
use App\Events\EventUpdatedPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerUpdatedpost
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
    public function handle(EventUpdatedPost $events)
    {
        $post = $events->req['body'][0];
        
        if(!$post){

            return back()->with('warning','Maapkeun tidak boleh kosong!');

            }  
                else 
                    {

                        $this->new_log->insert([
                                'username' => session()->get('privilages'),
                            'event' => 'Updated',
                        'logs_file' => $post
                    ]
                )
            ;
        }
    }
}
