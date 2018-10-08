@extends('layouts/app')

<link rel="stylesheet" href="{{ '/css/font-awesome.min.css' }}">
@section('content')
<div class="container">
    @if (Session::has('msg'))
    <div class="col-md-8">
        <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p>
    </div>
    @endif
    @foreach ($post as $postElement)
    <div class="row">
        <div class="col-md-8">

            <h1>{{ $postElement['title'] }}</h1>
            <p class="lead">{!! $postElement['content'] !!}</p>

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
    <div class="row">
        <div class="col-md-8">
            <div class="backend-comment">
                <h3>Commentaires du Post <small>( {{ $postElement->comments()->count() }} au total )</small></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Pseudo</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postElement->comments as $comment)
                        <tr>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{route('comments.edit', $comment->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="{{route('comments.delete', $comment->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Fin de la row -->
    @endforeach
</div>

@endsection
