@extends('layout')


@section('content')

<h1>Index Post</h1>
@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>  
@endif

@foreach ($Posts as $post)

<p>{{$post['title']}}</p>
    
@endforeach

@endsection