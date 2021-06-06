@extends('dashboard.layouts.master')

@section('title', 'Detail Post')

@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('blog.index') }}">Post</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Post - {{$item->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                      <h2>{{$item->title}}</h2>
                      <h6>Editor: {{$item->user->name}}</h6>
                      <img src="{{Storage::url($item->thumbnail)}}" class="img-fluid img-thumbnail w-25"/>
                      <p>{{$item->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-right">
                    @if (auth()->check() && auth()->user()->can('mereview-artikel'))
                      <form action="{{ route('blog.update-status', $item->id)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="reviewed">
                        <button type="submit" class="form-control btn btn-info px-5">
                            Review
                        </button>
                      </form>
                    @endif
                    </div>
                    <div class="col-6 text-right">
                    @if (auth()->check() && auth()->user()->can('menerbitkan-artikel'))
                      <form action="{{ route('blog.update-status', $item->id)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="status" value="published">
                        <button type="submit" class="form-control btn btn-success px-5">
                            Review and Publish
                        </button>
                      </form>
                    @endif
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@stop