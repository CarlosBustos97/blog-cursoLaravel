@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post )
            <div class="card mb-4">
                <div class="card-body">
                    @if ($post->image)
                    {{-- get_image corresponde a la funcion que se crea en el modelo --}}
                    {{-- Este debe estar en camelcase o con un raya al piso --}}
                        <img src="{{$post->get_image}}" class="card-img-top">
                    @elseif($post->iframe)
                        {{-- La clase ayuda a que ocupe el 100% del espacio --}}
                        <div class="embed-responsive embed-responsive-16by9">
                            {{-- Imprime el html des iframe en vez de solo el texto --}}
                            {!! $post->iframe !!}
                        </div>
                    @endif
                    <h5 class="card-title"> {{ $post->title }}</h5>
                    <p class="card-text">
                         {{ $post->get_excerpt }}
                         <a href="{{route('post',$post)}}">Leer más</a>
                    </p>
                    <p class="text-muted mb-0">
                        <em>
                            &ndash;{{ $post->user->name }}
                        </em>
                        {{ $post->created_at->format('d M Y') }}

                    </p>
                </div>
            </div>
                
            @endforeach
            {{-- Agrega paginación --}}
            {{ $posts->links()}}
            
        </div>
    </div>
</div>
@endsection
