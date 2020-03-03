<?php
   
namespace App\Http\Controllers;
   
use App\Post;
use App\Comment;
use Illuminate\Http\File;
use App\Jobs\ProcessComment;
use Illuminate\Http\Request;
use App\Events\EventUpdatedPost;
use Illuminate\Support\Facades\Storage;
use App\Listeners\EventListenerUpdatedpost;
   
class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
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

    public function UpdateChangedPosted(Request $request, $id){
        
        $input = $request->all();
        $post = Post::whereIn('id',[$input['post_id']])->first();

        if($request->hasFile('file'))
        {
            $image_name = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($image_name,PATHINFO_FILENAME);
            $image_ext = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $filename.'-'.time().'.'.$image_ext;
            $path = $request->file('file')->storeAs('public/News',$fileNameToStore);
           
        }  
            else {

                $fileNameToStore = $post->file;

        }

        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        $datapath = $storagePath.'News\\'.$post->file;

        if(file_exists($datapath)){
            Storage::delete($datapath);
            $post->file = $fileNameToStore;
            $post->save();
        }

        $data = Comment::where('id', $input['parent_id'])->update(['body' => implode('', $input['body'])]);
   
        event(new EventUpdatedPost($input));
                
        return back();

    }

}