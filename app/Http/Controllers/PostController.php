<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Post;
   
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
    
        return view('post.index', compact('post'));
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
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $data = new Post();
        $data->fill($request->all());
        $data->file = $fileNameToStore;
        $data->save();

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

        return back()->with(['success' => 'Data berhasil dihapus']);

    }
}