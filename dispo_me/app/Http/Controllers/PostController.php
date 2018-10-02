<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostModel;
use App\CategoryModel;
use Session;

class PostController extends Controller
{
    // Cette méthode protége l'ensemble des routes afin
    // que seul l'admin puisse y accéder
    public function __construct() {
        $this->middleware('is_admin');
    }
        /**
     * Display a listing of the resource on the welcome page.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // les lignes qui suivent sont là si on veut éviter d'utiliser un middleware Auth
        // $user = Auth::user();
        // var_dump($user);
        // if ($user['is_admin'] == 1) {
        //     $posts = PostModel::orderBy('id', 'DESC')->paginate(10);
        //     return view ('index_post')->with('Posts', $posts);
        // } else {
        //     // On récupére les 7 derniers posts (sort DESC)
        //     $posts = PostModel::orderBy('id', 'DESC')->take(7)->get();

        //     // On les envoie à la welcome page
        //     return view ('welcome')->with('posts', $posts);
        // }
        $posts = PostModel::orderBy('id', 'DESC')->paginate(10);
        return view ('index_post')->with('Posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = CategoryModel::all();
        return view ('create_post')->withCategories($categories);        
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
            'post_slug' => 'required|alpha_dash|min:4|max:255|unique:post_models,slug',
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
        $post->slug = $request->post_slug;
        // A ajouter si on veut add les catégories aux posts
        // $post->category_id = $request->post_category;
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
        $categories = CategoryModel::all();
        return view('edit_post')->withPost($post)->withCategories($categories);
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
        // Validation du formulaire update_post
        // le if statement est là pour le slug qui doit être 
        // unique. Lors de l'update comme il est déjà présent en DB
        // cela causerait un bug sans ce if statement
        $post = PostModel::find($id);
        if ($request->post_slug == $post->slug) {
            $validatesData = $request->validate([
                'post_title' => 'required|max:255',
                'post_text' => 'required',
                'post_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            ]);
        } else {
            $validatesData = $request->validate([
                'post_title' => 'required|max:255',
                'post_text' => 'required',
                'post_image' => 'required|mimes:png,jpg,jpeg|max:2048',
                'post_slug' => 'required|alpha_dash|min:4|max:255|unique:post_models,slug',
            ]);
        }

        // On récupére les data qu'on veut update
        $user_id = Auth::id();
        $image = $request->file('post_image');
        $newImageName = rand(). '.' . $image->getClientOriginalExtension();
        $newImageName = 'img/post_img/'.$newImageName;
        $image->move(public_path('img/post_img'), $newImageName);

        // Save dans DB si validation OK
        $post->title = $request->post_title;
        $post->content = $request->post_text;
        $post->author_id = $user_id;
        $post->img_path = $newImageName;
        $post->slug = $request->post_slug;
        $post->save();

        // On créé un flash message qui sera envoyé à la prochaine view (only once)
        Session::flash('msg', 'Le post a bien été update dans le base de données');
        
        // redirection vers la page souhaitée
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //On récupére le post qui a été passé en paramétre
        $post = PostModel::find($id);

        // On l'efface
        $post->delete();

        // On indique que tout s'est bien passé via un flas message
        Session::flash('msg', 'Le post a bien été supprimé dans le base de données');

        return redirect()->route('posts.index');
        
    }
}
