<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostModel;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = PostModel::all();
        return view ('index_post')->with('Posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view ('create_post');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation du formulaire create_post
        $validatesData = $request->validate([
            'post_title' => 'required|max:255',
            'post_text' => 'required',
            'post_image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        // On récupére id de l'author ainsi que l'image
        // pour save le post
        $user_id = Auth::id();
        $image = $request->file('post_image');
        $newImageName = rand(). '.' . $image->getClientOriginalExtension();
        $newImageName = 'img/post_img/'.$newImageName;
        $image->move(public_path('img/post_img'), $newImageName);
        // Save dans DB si validation OK
        $post = new PostModel;
        $post->title = $request->post_title;
        $post->content = $request->post_text;
        $post->author_id = $user_id;
        $post->img_path = $newImageName;
        $post->save();

        // On créé un flash message qui sera envoyé à la prochaine view (only once)
        Session::flash('msg', 'Le post a bien été sauvé dans le base de données');
        
        // redirection vers la page souhaitée
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = PostModel::where('id', $id)->take(1)->get();
        return view ('show_post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = PostModel::find($id);
        return view('edit_post')->withPost($post);
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
        // Validation du formulaire create_post
        $validatesData = $request->validate([
            'post_title' => 'required|max:255',
            'post_text' => 'required',
            'post_image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);
        // On récupére id de l'author ainsi que l'image
        // pour save le post
        $user_id = Auth::id();
        $image = $request->file('post_image');
        $newImageName = rand(). '.' . $image->getClientOriginalExtension();
        $newImageName = 'img/post_img/'.$newImageName;
        $image->move(public_path('img/post_img'), $newImageName);
        // Save dans DB si validation OK
        $post = new PostModel;
        $post->title = $request->post_title;
        $post->content = $request->post_text;
        $post->author_id = $user_id;
        $post->img_path = $newImageName;
        $post->update();

        // On créé un flash message qui sera envoyé à la prochaine view (only once)
        Session::flash('msg', 'Le post a bien été sauvé dans le base de données');
        
        // redirection vers la page souhaitée
        return redirect('/posts');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('delete_post');
        
    }
}
