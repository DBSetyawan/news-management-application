<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Post;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\PostedComments;
use Illuminate\Support\Facades\Validator;

class APIpostsedComments extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }

    public function getALLposted()
    {
        return response()->json([
            'success' => true,
            'message' => 'success get data',
            'data' => new PostedComments(Post::with('comments')->get())
        ]);
    }

    public function getPaginationPost()
    {
        return response()->json([
            'success' => true,
            'message' => 'success get data',
            'data' => new PostedComments(Post::with('comments')->paginate(2))
        ]);
    }
    
}
