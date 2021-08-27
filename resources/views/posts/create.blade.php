@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Artículo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form 
                        action="{{route('posts.store')}}" 
                        method="POST" 
                        {{-- Convierte el archivo a un tipo de dato complejo--}}
                        {{-- así se puede guardar la imagen en el proyecto --}}
                        {{-- y capturar el nombre del archivo el cual se guardará en la DB --}}
                        enctype="multipart/form-data"
                    >
                    <div class="form-group">
                        <label>Título*</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="file" id="file" >
                    </div>

                    <div class="form-group">
                        <label>Contenido*</label>
                        <textarea name="body" id="body" rows="6" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Contenido Embebido</label>
                        <textarea name="iframe" id="iframe" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        @csrf
                        <input type="submit" value="Enviar" class="btn btn-sm btn-primary">
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection