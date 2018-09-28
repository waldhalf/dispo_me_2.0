@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        {!! Form::model($post, ['route' => ['post.update', $post->id]]) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Titre du post')}}
            {{ Form::text('title'), null, ["class" => 'form-control input-lg'] }}

            {{ Form::label('content', 'Contenu')}}
            {{ Form::textarea('content'), null, ["class" => 'form-control'] }}
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl>Created at:</dl>
                <dd>{{ date('j M, Y h:ia', strtotime($post->created_at)) }}</dd>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
    
@endsection