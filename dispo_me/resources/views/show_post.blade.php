@extends('layouts/app')


@section('content')
<div class="container">
    @foreach ($post as $postElement)
    <div class="row">
        <div class="col-md-8">

        <h1>{{$postElement['title']}}</h1>
        <p class="lead">{{$postElement['content']}}</p>

        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created at:</dt>
                    <dd>{{ date('j M , Y h:ia', strtotime($postElement['created_at']))}}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last updated:</dt>
                    <dd>{{ date('j M , Y h:ia', strtotime($postElement['updated_at']))}}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{url ('/posts/'.$postElement['id'].'/edit')}}" class="btn btn-primary btn-block">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{url ('/posts/'.$postElement['id'].'/delete')}}" class="btn btn-danger btn-block">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection