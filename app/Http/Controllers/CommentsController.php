<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Comment;
   
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
    
        Comment::create($input);
   
        return back();
    }

    public function updateDataNews(Request $request, $id)
    {
    	// $request->validate([
        //     'body'=>'required',
        // ]);
   
        $input = $request->all();
        
        // dd($input);die;
        // $input['user_id'] = auth()->user()->id;
        Comment::where('id', $input['parent_id'])
                // ->whereIn('post_id', [$input['parent_id']])
                // ->whereIn('parent_id', [$input['parent_id']])
                ->update(['body' => implode('', $input['body'])]);
   
        return back();
    }
}