@section('content')
<div class="container">
    @foreach ($post as $truc)
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="/{{$truc['img_path']}}" alt="image job">
            <div class="card-body">
                <h5 class="card-title">{{$truc['title']}}</h5>
                <p class="card-text">{{$truc['content']}}</p>
                {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
@endforeach
</div>
@endsection