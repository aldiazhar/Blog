@extends('dashboard.layouts.master')

@section('title', 'Comments Post')

@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- End Datatables -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comments Post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('blog.index') }}">Post</a></li>
            <li class="breadcrumb-item active">Comments Post</li>
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
              <h3 class="card-title">Title Post - {{$item->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table">
                <thead>
                <tr>
                  <th>User</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item->comments as $key=>$comment)
                  <tr>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->description}}</td>
                    <td>{{$comment->status}}</td>
                    <td>
                      <form action="{{route('blog.comments.delete',$comment->id)}}" method="post">
                          {{method_field('delete')}}
                          {{csrf_field()}}
                          <button class="btn btn-danger" type="submit">
                              Delete
                          </button>
                      </form>
                      <form action="{{route('blog.comments.accept',$comment->id)}}" method="post">
                          @method('put')
                          @csrf
                          <input type="hidden" name="status" value="published">
                          <button class="btn btn-success" type="submit">
                              Accept
                          </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>User</th>
                  <th>Description</th>
                  <th>Status</th>
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