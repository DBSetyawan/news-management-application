<?php
   
namespace App\Http\Controllers;
   
use App\Post;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\EventDeletedPost;
use App\Events\EventCreateNewPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Listeners\EventListenerDeletedPost;
   
class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        $accessable = Redis::get('accessable');
    
        return view('post.index', compact('post','accessable'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
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
            'title'=>'required',
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'body'=>'required',
        ]);

        if($request->hasFile('file'))
        {
            $image_name = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($image_name,PATHINFO_FILENAME);
            $image_ext = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $filename.'-'.time().'.'.$image_ext;
            $path = $request->file('file')->storeAs('public/News',$fileNameToStore);
           
        }
            else 
                    {
                         $fileNameToStore = 'noimage.jpg';
        }

        $data = new Post();
        $data->fill($request->all());
        $data->file = $fileNameToStore;
        $data->save();

        event(new EventCreateNewPost($data));

        return redirect()->route('post.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$post = Post::find($id);
        return view('post.show', compact('post'));
    }
    
    public function hapus($id){
        $deletedRows = Post::findOrFail($id)->delete();
        event(new EventDeletedPost($deletedRows, $id));
        return back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function UpdateDataNews($id){
        $post = Post::find($id);
        $commentx = Comment::whereIn('post_id', [$id])->get();
        $d = Carbon::Now();
        return view('post.detail_news', compact('post','commentx','d'));

    }
}