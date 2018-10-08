<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\PostModel;
use Session;

class CommentsController extends Controller
{
    // Cette méthode protége l'ensemble des routes afin
    // que seul l'admin puisse y accéder
    public function __construct() {
        $this->middleware('is_admin',['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, array(
            'name'=>'required|max:255', 
            'email'=>'required|email|max:255',
            'comment'=>'required|min:5|max:2000',
        ));
        $post = PostModel::find($id);
        
        $comment = new Comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved = TRUE;
        $comment->post()->associate($post);
        // dd($comment);
        $comment->save();

        Session::flash('msg', 'Le commentaire a été ajouté');

        return redirect()->route('post.show', [$post->slug]);

        // dd($request, $post_id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comment_edit')->withComment($comment);
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
        $this->validate($request, array('comment' => 'required'));
        $comment = Comment::find($id);
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;

        $comment->save();

        Session::flash('msg', 'Le commentaire a été updaté');
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        Session::flash('msg', 'Le commentaire a été effacé');
        return redirect()->route('posts.show', $comment->post->id);
    }
}
