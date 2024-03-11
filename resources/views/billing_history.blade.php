@extends('layouts.app')

@section('title') {{'paymentHistory'}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@append

@section('js')
<!-- Bootstrap 4 -->
<script src="{{asset('auth/plugins/bootstrap/js/bootstrap.bundle.min.js')}}">></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('auth/dist/js/demo.js')}}"></script>
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
    $("#payment_history").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#mylist_wrapper .col-md-6:eq(0)');
  });
</script>
@append

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Payment History List</h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="card">
    <!-- /.card-header -->
  @if(isset($payment))
  <div class="card-body">
    <table id="payment_history" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Transaction id</th>
        <th>Amount</th>
        <th>Card Number</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
        @foreach($payment as $data)
          <tr>
            <td>{{$data->transaction_id}}</td>
            <td>{{$data->amount}}</td>
            <td>{{$data->last4}}</td>
            <td>{{$data->created_at}}</td>
            <td>{{$data->payment_status}}</td>
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
