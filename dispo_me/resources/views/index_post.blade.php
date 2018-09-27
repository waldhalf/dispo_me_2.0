@extends('layout')


@section('content')

<h1>Index Post</h1>
@if (Session::has('msg'))
    <p class="alert alert-success" role="alert">{{ Session::get('msg') }}</p> 
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Contenu</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    @foreach ($Posts as $post)
        <tbody>
          <tr>
            <td></td>
            <td>{{$post['title']}}</td>
            <td>{{$post['content']}}</td>
            <td><a href="#"><img style="width:20px; height:20px;" src="img/edit_icone.png" alt=""></a></td>
            <td><a href="#"><img style="width:20px; height:20px;" src="img/delete_icone.png" alt=""></a></td>
          </tr>
        </tbody>
        @endforeach
</table>

{{ time() }}

{{-- <img style="width:30px; height:30px;" src="{{$post['img_path']}}" alt="une image" srcset="">  --}}

    

@endsection