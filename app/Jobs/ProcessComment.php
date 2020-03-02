<?php

namespace App\Jobs;

use App\Comment;
use App\Log_news;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Log_news $new_log)
    {
        $comment = $this->comment;
        $new_log->insert([
            'username' => session()->get('privilages'),
            'event' => 'Queue Job Successed',
            'logs_file' => $comment->body
        ]);
    }
}
