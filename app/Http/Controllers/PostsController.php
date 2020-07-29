<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use DB;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['only' => ['create','store']]);
        $this->middleware('auth:admin', ['only' => ['index','show', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        $data = array(
            'user' => $user,
            'posts' => $posts,
        );
        return view('posts.index')->with($data);
    }

    function upload(Request $request)
    {
     //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'title'=>'required',
                'body'=>'required',
                'cover_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 
        //Create Post
        $post=new Post;
        $incidentlat = $request->input('commentlat');
        $incidentlong = $request->input('commentlon');
        $address = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$incidentlat,$incidentlong&key=AIzaSyAIw269bXf_I8SJmtTRlxs6GqvfEdKKo1I");
        $json_address = json_decode($address);
        $full_address = $json_address->results[0]->formatted_address;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id =auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->lat = $incidentlat;
        $post->lng = $incidentlong;
        $post->address = $full_address;
        $post->save();

        return redirect('/posts/create')->with('success','You have successfully incident');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$post=Post::orderBy('title','desc')->get();
       // return Post::find($id);
      //$posts=DB::select('SELECT*FROM posts');
      //$posts=Post::orderBy('title','desc')->take(1)->get();
        $post =Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::find($id);
        $post->delete();
        return redirect('/posts')->with ('sucess','Post Removed');
    }

}
