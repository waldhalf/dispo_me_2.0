<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostModel;
use Session;
use Mail;

class PublicPostController extends Controller
{

    public function welcome() {
        // On récupére les 7 derniers posts (sort DESC)
        $posts = PostModel::orderBy('id', 'DESC')->take(7)->get();

        // On les envoie à la welcome page
        return view ('welcome')->with('posts', $posts);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostModel::orderBy('id', 'DESC')->paginate(5);

        return view('public_index_posts')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = PostModel::where('slug','=', $slug)->get();
        return view ('public_show_post')->withPost($post);
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
        //
    }

    public function sendContact(Request $request) {
        $this->validate($request, array(
            'name_contact_form'     => 'required',
            'email_contact_form'    => 'required|email',
            'message_contact_form'  => 'required'
        ));

        $data = array(
            'name'          =>$request->name_contact_form,
            'email'         =>$request->email_contact_form,
            'bodyMessage'   =>$request->message_contact_form
    );

        Mail::send('email_contact', $data, function($message_closure) use ($data) {
            $message_closure->from($data['email']);
            $message_closure->subject('Message en provenance de Dispo.me');
            $message_closure->to('dispo.me.contact@gmail.com');
        });
        Session::flash('msg', 'Votre message a bien été envoyé. Nous reviendrons vers vous dans les plus brefs délais.');

        return redirect(url()->previous() . '#anchor_form');   
    }
}
