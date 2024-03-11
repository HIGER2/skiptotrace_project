@extends('layouts.app')

@section('title') {{'Add Credits'}} @endsection

@section('js')
<script>
$(function() {

      $(".form-control").focus(function(){
        $(this).removeClass('is-invalid');
        $(this).parent().removeClass('has-error');
        $(this).parent().parent().removeClass('has-error');
     });

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=text]','select'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $('.is-invalid').removeClass('is-invalid');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $input.addClass('is-invalid');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
    });
  });
</script>
@append

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1 class="m-0">Add Credits</h1>
      </div>
      <div class="col-sm-2">
        <a href="addCard" class="btn btn-primary btn-block btn-lg"><i class="fa fa-credit-card"></i> Add Card</a>
      <div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- left column -->
<div class="col-md-12">

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="error_div">
              @if ( $errors->count() > 0 )
              <p class="error_title">The following errors have occurred:</p>

              <ul>
                @foreach( $errors->all() as $message )
                  <li>{{ $message }}</li>
                @endforeach
              </ul>
            @endif
          </div>
          @if (Session::has('danger'))
          <div class="alert alert-danger">
            <i class="fas fa-check-circle"></i> {{ Session::get('danger') }}
          </div>
        @endif

          @if (Session::has('success'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
          </div>
        @endif
          <!-- form start -->
          <form name="buy_skips" method="post" action="{{ url('/add_credits') }}" class="require-validation">
            {{ csrf_field() }}

            <div class="card-body">
              <div class="form-group required">
                <label for="formchoose_card">Choose card</label>
                <select class="form-control" name="choose_card">
                    <option value=""> Choose Card</option>
                    @if(isset($payment))
                      @foreach($payment as $data)
                        <option value="{{$data->card_id}}"> {{$data->card_number}}</option>
                      @endforeach
                    @endif
                  </select>
              </div>
              <div class="form-group required">
                <label for="formInputlast">Amount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="text" name="amount" class="form-control" placeholder="Enter Amount">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      </div>
    </section>


@endsection
