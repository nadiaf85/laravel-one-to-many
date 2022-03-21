@extends('layouts.admin')
  
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3>Crea nuovo Post</h3>
                    <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo" value="{{old("title")}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Contenuto</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Inserisci il contenuto">{{old("content")}}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Categoria del post --}}
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control form-control-md" name="category_id">
                                <option value="">--seleziona categoria--</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Immagine del post --}}
                        <div class="form-group">
                            <label for="image">Inserisci un immagine</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Crea</button>
                        <a href="{{route("admin.posts.index")}}"><button type="button" class="btn btn-primary">Torna ai posts</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
    </div>
@endsection

