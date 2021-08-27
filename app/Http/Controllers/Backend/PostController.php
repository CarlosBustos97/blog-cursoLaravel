<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;
//Trae la clase que nos sirve para eliminar la imagen
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        //Envia los datos como si fuera un array
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $PostRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //salvar
        //Crea un nuevo post
        $post = Post::create([
            //obtiene el id del usuario que esta logueado
            'user_id'   => auth()->user()->id
            //obtiene todos los campos del formulario
        ]+ $request->all());

        //image
        //Valida si se esta recibiendo un archivo con el campo file
        if($request->file('file')){
            //crea una carpeta posts en public donde guardara la imagen 
            //en base de datos de guardará la ruta de la imagen
            $post->image = $request->file('file')->store('posts','public');
            $post->save();
        }

        //retorna a la vista anterio
        //@status variable de sesión de tipo flash que se podrá imprimir en la vista
        return back()->with('status', 'Creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $PostRequest
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // dd($request->all());
        $post->update($request->all());
        //image
        //Valida si se esta recibiendo un archivo con el campo file
        if($request->file('file')){
            //Eliminar Imagen de la carpeta storage/public/post
            Storage::disk('public')->delete($post->image);
            //crea una carpeta posts en public donde guardara la imagen 
            //en base de datos de guardará la ruta de la imagen
            $post->image = $request->file('file')->store('posts','public');
            $post->save();
        }
        return back()->with('status', 'Actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Eliminar Imagen
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return back()->with('status','Eliminado con éxito');
    }
}
