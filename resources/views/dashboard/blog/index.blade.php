@extends('dashboard.layouts.master')

@section('title', 'Blog Post')

@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- End Datatables -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Blog Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Blog</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Blog Post</h3>
              <div class="float-right d-none d-sm-block">
                @if (auth()->check() && auth()->user()->can('menulis-artikel'))
                <a href="{{route('blog.create')}}" title="Create Post" class="btn-xs btn btn-success">
                  <i class="fas fa-plus"></i>
                </a>
                @endif
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table">
                <thead>
                <tr>
                  <th>Thumbnail</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Comments</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $key=>$post)
                  <tr>
                    <td><img src="{{Storage::url($post->thumbnail)}}" style="max-height:120px;"/></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->status}}</td>
                    <td>
                      @if (auth()->check() && auth()->user()->can('menerbitkan-komen'))
                        <p><a href="{{route('blog.comments',$post->id)}}">{{$post->comments->count()}} Comments</a></p>
                      @else
                        <p>{{$post->comments->count()}} Comments</p>
                      @endif
                    </td>
                    <td>
                      <a href="{{route('blog.show',$post->id)}}">
                        <i class="fas fa-eye text-success"></i>
                      </a>
                      @if (auth()->check() && auth()->user()->can('mengedit-artikel'))
                      <a href="{{route('blog.edit',$post->id)}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      @endif
                      @if(auth()->check() && auth()->user()->hasRole('super-admin'))
                      <form action="{{route('blog.destroy',$post->id)}}" method="post">
                          {{method_field('delete')}}
                          {{csrf_field()}}
                          <button class="btn text-danger" type="submit">
                              <i class="fa fa-trash"></i>
                          </button>
                      </form>
                      @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Thumbnail</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Comments</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
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
<!-- DataTables -->
<script src="{{url('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "ordering": false,
    });
  });
</script>
@stop