@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$item->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                      <small>Editor: {{$item->user->name}} | Date: {{$item->created_at->diffForHumans()}}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <img src="{{Storage::url($item->thumbnail)}}" class="img-fluid img-thumbnail w-25"/>
                      <p>{{$item->description}}</p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <form action="{{ route('comment-save')}}" method="post" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="status" value="sended">
                <input type="hidden" name="blog_id" value="{{$item->id}}">
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" style="resize: none;" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success px-5">Send</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <hr>
                </div>
            </div>
            @forelse($item->comments as $comment)
                <div class="row">
                    <div class="col-md-3">
                        <b>{{$comment->user->name}}</b>
                    </div>
                    <div class="col-md-9">{{$comment->description}}</div>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>
            @empty
                <p>No Comment</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
