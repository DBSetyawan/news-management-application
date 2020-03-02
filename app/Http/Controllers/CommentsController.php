<?php
   
namespace App\Http\Controllers;
   
use App\Comment;
use App\Jobs\ProcessComment;
use Illuminate\Http\Request;
use App\Events\EventUpdatedPost;
use App\Listeners\EventListenerUpdatedpost;
   
class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        $comment = Comment::create($input);

        ProcessComment::dispatch($comment);
            
        return back();
    }

    public function updateDataNews(Request $request, $id)
    {
    	$request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        
        $data = Comment::where('id', $input['parent_id'])->update(['body' => implode('', $input['body'])]);
   
        event(new EventUpdatedPost($input));
                
        return back();
    }
}