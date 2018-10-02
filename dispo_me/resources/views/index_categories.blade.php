@extends('layout')


@section('content')

@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
@endif

<div class="row">
    <div class="col-md-8">
        <h1>Catégories</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom de la catégorie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category['id']}}</td>
                    <td>{{$category['category_name']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!--fin de la md-8-->
    
    <div class="col-md-3">
        <br><br>
        <div class="jumbotron">
            {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
            <h2>Nouvelle catégorie</h2>
            {{ Form::label('category_name', 'Nom de la catégorie: ')}}
            {{ Form::text('category_name', null, ['class' => 'form-control'])}}
            {{ Form::submit('Créer', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:5px;']) }}
            {!! Form::close() !!}
        </div>
    </div><!--fin de la md-3-->
</div>

@endsection