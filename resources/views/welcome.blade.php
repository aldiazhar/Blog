@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($posts as $post)
            <a class="nav-blog" href="{{route('details',$post->slug)}}">
                <div class="card mb-3">
                    <div class="card-header">
                        {{$post->title}}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <small>Editor: {{$post->user->name}} | Date: {{$post->created_at->diffForHumans()}}</small>
                                <p>{{$post->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
                <p>No Post</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
