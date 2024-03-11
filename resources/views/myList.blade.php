@extends('layouts.app')

@section('title') {{'myList'}} @endsection

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
<script src="{{asset('auth/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('auth/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('auth/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  jQuery(function ($) {
    $("#mylist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "colvis"]
    }).buttons().container().appendTo('#mylist_wrapper .col-md-6:eq(0)');
  });
</script>
@append

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1 class="m-0">Skip Tracing List</h1>
      </div>
      <div class="col-sm-2">
        <a href="{{route('csvList')}}" class="btn btn-primary btn-block btn-lg">Back</a>
      <div>

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
        <th>Id</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zipcode</th>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>

        <th>Phone</th>
        <th>Line Type</th>
        <th>Alt Phone 1</th>
        <th>Alt Line Type 1</th>
        <th>Alt Phone 2</th>
        <th>Alt Line Type 2</th>
        <th>Alt Phone 3</th>
        <th>Alt Line Type 3</th>
        <th>Alt Phone 4</th>
        <th>Alt Line Type 4</th>
        <th>Alt Phone 5</th>
        <th>Alt Line Type 5</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
        @foreach($skips as $data)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->address}}</td>
            <td>{{$data->city}}</td>
            <td>{{$data->state}}</td>
            <td>{{$data->zipcode}}</td>

            <td>{{$data->fname}}</td>
            <td>{{$data->lname}}</td>
            <td>{{$data->email}}</td>

            <td>{{$data->phone}}</td>
            <td>{{$data->line_type}}</td>
            <td>{{$data->alt_phone_1}}</td>
            <td>{{$data->alt_line_type_1}}</td>
            <td>{{$data->alt_phone_2}}</td>
            <td>{{$data->alt_line_type_2}}</td>
            <td>{{$data->alt_phone_3}}</td>
            <td>{{$data->alt_line_type_3}}</td>
            <td>{{$data->alt_phone_4}}</td>
            <td>{{$data->alt_line_type_4}}</td>
            <td>{{$data->alt_phone_5}}</td>
            <td>{{$data->alt_line_type_5}}</td>
            <td>{{$data->status}}</td>
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
