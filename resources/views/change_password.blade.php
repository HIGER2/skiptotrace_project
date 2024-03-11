@extends('layouts.app')
@section('title') {{'Change Password'}} @endsection

@section('js')
<!-- bs-custom-file-input -->
<script src="{{asset('auth/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script>
$(function () {
  $('#changePassword_form').validate({
    rules: {
      current_password: 'required',
	    new_password: 'required',
	    confirm_password: {
	        required: true,
	        equalTo : "#new_password",
      }
    },
    messages: {
      current_password: {
        required: "Current Password is required"
      },
      new_password: {
        required: "New Password is required"
      },
  		confirm_password: {
  			 required : 'Confirm Password is required',
  			  equalTo : 'Password not matching',
  		}
    },
    errorElement: 'span',
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
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
            <h1>Change Password</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

              <!-- form start -->
              <form id="changePassword_form" action="{{ url('change_password') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                      <label for="Current password">Current Password</label>
                      <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Current Password">
                    </div>

                    <div class="form-group">
                      <label for="New password">New Password</label>
                      <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                    </div>

                    <div class="form-group">
                      <label for="Confirm password">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
              </form>

            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
