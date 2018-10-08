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
            <th scope="col">Créé le</th>
            <th scope="col">Voir</th>
            <th scope="col">Effacer</th>
        </tr>
    </thead>
    @foreach ($Posts as $post)
        <tbody>
          <tr>
            <td>{{$post['id']}}</td>
            <td>{{$post['title']}}</td>
            <td>{!! substr($post['content'], 0, 50)!!}{!!strlen($post['content']) > 50 ? "..." : ""!!}</td>
            <td>{{ date('j M, Y', strtotime($post['created_at'])) }}</td>
            <td><a href="{{url ('/posts/'.$post['id'].'/show') }}"><img style="width:20px; height:20px;" src="img/edit_icone.png" alt="image edit"></a></td>
            <td><a href="{{url ('/posts/'.$post['id'].'/delete')}}"><img style="width:20px; height:20px;" src="img/delete_icone.png" alt="image delete"></a></td>
          </tr>
        </tbody>
        @endforeach
</table>
<div class="text-center">
    {!! $Posts->links(); !!}
</div>
{{-- <img style="width:30px; height:30px;" src="{{$post['img_path']}}" alt="une image" srcset="">  --}}
    

@endsection