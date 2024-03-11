@extends('layouts.app')

@section('title') {{'Single Skip'}} @endsection

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
$(function() {
  var skip_total=$('.total_skips').val();
  if(skip_total == 0){
      $('#modal-info').modal('show');
  }

  $("#mylist").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,"searching": false, "paging": false, 
  });

});
</script>
@append

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Single Skip</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- left column -->
<div class="col-md-12">

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="error_div">
              @if (isset($custom_error))
              <p class="alert alert-danger">{{ $custom_error }}</p>
              @endif
            </div>
          <!-- form start -->
          <form name="singleskip" method="post" action="{{ url('/singleSkip') }}" class="form_singleskip">
            {{ csrf_field() }}

            <div class="card-body">
              <div class="form-group">
                <label for="formInputfirst">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
              </div>
              <div class="form-group">
                <label for="formInputlast">Last name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last name">
              </div>
              <div class="form-group">
                <label for="formInputaddress">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter Address">
              </div>
              <div class="form-group">
                <label for="formInputcity">City</label>
                <input type="text" name="city" class="form-control" placeholder="Enter City">
              </div>
              <div class="form-group">
                <label for="formInputstate">State</label>
                <input type="text" name="state" class="form-control" placeholder="Enter State">
              </div>
              <div class="form-group">
                <label for="formInputzipcode">Zipcode</label>
                <input type="text" name="zipcode" class="form-control" placeholder="Enter Zipcode">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="form-group">
                <input type="hidden" name="total_skips" class="form-control total_skips" value="{{$total_skips}}">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->

        @if(isset($data))
        <table id="mylist" class="table table-bordered table-striped">
          <thead>
          <tr>
            @foreach($data as $key=>$value)
                <th>{{$key}}</th>
            @endforeach
          </tr>
          </thead>
          <tbody>
              <tr>
                @foreach($data as $key=>$value)
                    <th>{{$value}}</th>
                @endforeach
              </tr>
          </tbody>
        </table>
        @endif

      </div>
      </div>
    </section>

    <div class="modal fade show" id="modal-info" aria-modal="true" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Low Balance</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Your account balance is low, Recharge to use Skips.</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default"><a href="/buy_skips">Ok</a></button>
               </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

@endsection
