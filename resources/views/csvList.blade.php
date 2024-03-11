@extends('layouts.app')

@section('title') {{'CSV List'}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@append

@section('js')

<!-- AdminLTE for demo purposes -->
<script src="{{asset('auth/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">></script>
<script src="{{asset('auth/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">></script>
<script>
  jQuery(function ($) {
    $("#mylist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    });
  });
</script>
@append

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Skip Tracing List</h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="card">
  @if(isset($skips))
  <div class="card-body">
    <table id="mylist" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>CSV File</th>
        <th>Total Records</th>
        <th>Pending Records</th>
        <th>Success</th>
        <th>Found</th>
        <th>Not Found</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach($skips as $data)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->file_name}}</td>
            <td>{{$data->total_records}}</td>
            <td>{{$data->pending}}</td>
            <td>{{$data->success}}</td>
            <td>{{$data->found}}</td>
            <td>{{$data->not_found}}</td>
            <td>
              <a href="myList/{{$data->id}}" class="btn btn-block btn-info">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
  @else
    <p>No Record Found</p>
  @endif

</div>


@endsection
