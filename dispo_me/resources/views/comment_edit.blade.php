@extends('layouts/app')

<link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}">
@section('content')
<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="comment-form">
            @csrf
            @if (Session::has('msg'))
            <div class="col-md-8">
                <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
            </div>
            @endif
            {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('name', 'Nom: ')}}
                    {{ Form::text('name', null, ['class' => 'form-control'])}}
                    @if ($errors->has('name'))
                    <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    {{ Form::label('email', 'Email: ')}}
                    {{ Form::text('email', null, ['class' => 'form-control'])}}
                    @if ($errors->has('email'))
                    <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    {{ Form::label('comment', 'Commentaire: ')}}
                    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])}}
                    @if ($errors->has('comment'))
                    <p class="alert alert-danger">{{ $errors->first('comment') }}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    {{ Form::submit('Modifier le commentaire', ['class' => 'btn btn-success mt-3 mb-3 btn-block'])}}
                </div>
            </div><!-- Fin de la row -->
            {{ Form::close() }}
        </div>
    </div><!-- Fin de la row 2 -->

@endsection
