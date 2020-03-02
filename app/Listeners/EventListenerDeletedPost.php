<?php

namespace App\Listeners;

use App\Log_news;
use App\Events\EventDeletedPost;
use App\Events\EventCreateNewPost;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListenerDeletedPost
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
    public function handle(EventDeletedPost $event)
    {
        if($event == true){
            $post_id = $event->id;
                    $this->new_log->insert([
                        'username' => session()->get('privilages'),
                        'event' => 'Deleted',
                        'logs_file' => 'ID '.$post_id.' berhasil dihapus.'
                    ]
                )
            ;
        } 
            else {

                return back()->with('danger','Maapkeun ID tidak dapat dihapus!');

        }
      
    }
}
