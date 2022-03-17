@extends('layouts.admin')
  
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">Posts</h1>
                <div class="mb-4">
                    <a href="{{route('admin.posts.create')}}" class="btn btn-primary">Crea post</a>
                </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Contenuto</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->slug}}</td>
                        <td>{{$post->category? $post->category->title : '-'}}</td>
                        <td><a href="{{route('admin.posts.show',$post->id)}}"><button type="button" class="btn btn-primary">Vedi</button></a></td>
                        <td><a href="{{route('admin.posts.edit',$post->id)}}"><button type="button" class="btn btn-warning">Modifica</button></a></td>
                        <td><a href="">
                            <form action="{{route("admin.posts.destroy", $post->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Rimuovi</button>
                            </form>
                            </a></td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection

