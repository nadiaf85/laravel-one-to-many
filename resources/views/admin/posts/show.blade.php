@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p>{{$post->id}}</p>
                <h2>{{$post->title}}</h2>
                <h4>{{$post->content}}</h4>
                <p>{{$post->slug}}</p>
                @if($post->image)
                    <img src="{{asset("storage/{$post->image}")}}" alt="{{$post->title}}">
                @endif
            </div>
        </div>
        <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">Torna ai posts</button></a>
    </div>
@endsection