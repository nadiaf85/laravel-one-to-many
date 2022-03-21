<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validate = [
        'title'=>'required|max:150|string',
        'content'=>'required',
        'category_id'=>'nullable|exists:categories,id',
        'image'=>'nullable|image|mimes:jpeg, bmp, png,jpg|max:2048'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validate);

        $data_form = $request->all();

        if(isset($data_form['image'])){
            //salvo l'immagine che mi arriva dal client,nella mia cartella uploads
            $img_path = Storage::put('uploads',$data_form['image']); 
            //salvo il percorso sul post nel db
            $data_form['image'] = $img_path;
        }

        //creo lo slug inserendo un - al posto degli spazi
        $slug = Str::slug($data_form['title']);

        //faccio un controllo se lo slug esiste già.Se esiste inserisco un - alla fine,seguito da un numero(in modo da non avere doppioni)
        $count = 1;
        while(Post::where('slug', $slug)->first()){
            $slug = Str::slug($data_form['title'])."-".$count;
            $count ++;
        }

        $data_form['slug'] = $slug;
        $newPost = new Post();
        
        $newPost->fill($data_form);
        $newPost->save();
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $request->validate($this->validate);

        $data_form = $request->all();

        if($post->title == $data_form['title']){            
            $slug = $post->slug;
        }else{
            $slug = Str::slug($data_form['title']);        
            $count = 1;
            while(Post::where('slug', $slug)->where('id', '!=', $post->id)->first()){
                $slug = Str::slug($data_form['title'])."-".$count;
                $count ++;
            }
        }
        $data_form['slug'] = $slug;
        
        $post->update($data_form);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
