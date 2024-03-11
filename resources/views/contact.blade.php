@extends('layouts.app')
@section('title') {{'Contact Us'}} @endsection

@section('js')
<!-- bs-custom-file-input -->
<script src="{{asset('auth/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script>

$.validator.addMethod('customphone', function (value, element) {
        return this.optional(element) || /^(\+91-|\+91|0)?\d{10}$/.test(value);
    }, "Please enter a valid phone number");
$(function () {

  $('#contact_form').validate({
    rules: {
      inputName: 'required',
	    inputEmail: {
         required: true,
         email: true,
      },
      inputPhone:{
       required: true,
       customphone: true,
      },
      inputSubject: 'required',
	    inputMessage: 'required',
    },
    messages: {
      inputName: "Please enter name",
      inputEmail: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      inputPhone: {
        required: "Please enter a phone number",
        customphone: "Please enter a vaild phone number"
      },
      inputSubject: "Please enter subject",
      inputMessage: "Please enter message",
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
            <h1>Contact us</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2>Skip <strong>To Trace</strong></h2>
              <p class="lead mb-5">Address
              </p>
            </div>
          </div>
          <div class="col-7">
            <form id="contact_form" action="{{ url('contact') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" name="inputName" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Phone</label>
                <input type="text" name="inputPhone" id="inputPhone" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputEmail">E-Mail</label>
                <input type="email" name="inputEmail" id="inputEmail" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputSubject">Subject</label>
                <input type="text" name="inputSubject" id="inputSubject" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputMessage">Message</label>
                <textarea id="inputMessage" name="inputMessage" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Send message">
              </div>
          </form>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->

@endsection
