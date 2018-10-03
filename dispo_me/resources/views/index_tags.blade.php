<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

@extends('layout')

@section('content')

@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
@endif

<div class="row">
    <div class="col-md-8">
        <h1>Tags</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th >#</th>
                    <th >Nom du tag</th>
                    <th >Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{$tag['id']}}</td>
                    <td>{{$tag['skill_name']}}</td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-default btn-lg "> <i class="glyphicon glyphicon-edit text-primary"></i> </a>
                        <a href="{{route ('tags.delete', $tag['id']) }}" class="btn btn-default btn-lg "> <i class="glyphicon glyphicon-trash text-danger"></i> </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!--fin de la md-8-->
    
    <div class="col-md-3">
        <br><br>
        <div class="jumbotron">
            {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
            <h2>Nouvelle compétence</h2>
            {{ Form::label('skill_name', 'Nom de la compétence: ')}}
            {{ Form::text('skill_name', null, ['class' => 'form-control'])}}
            {{ Form::submit('Créer', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:5px;']) }}
            {!! Form::close() !!}
        </div>
    </div><!--fin de la md-3-->
</div>


@endsection