@extends('admin.layouts.master')

@section('title', 'All Users')

@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<!-- End Datatables -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
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
              <h3 class="card-title">User Index</h3>
              <div class="float-right d-none d-sm-block">
                <a href="{{route('users.create')}}" title="Create User" class="btn-xs btn btn-success">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Roles</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{implode (',',$user->roles()->get()->pluck('role_name')->toArray())}}</td>
                    <td>
                      <a href="{{url('admin/users/edit')}}/{{$user->id}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a onclick="return confirm('This data will be deleted permanently! Are you sure?')" href="{{url('admin/users/delete')}}/{{$user->id}}">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>E-Mail</th>
                  <th>Roles</th>
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