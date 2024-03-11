@extends('layouts.app')

@section('title') {{'Stripe Payment'}} @endsection

@section('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    $(".form-control").focus(function(){
      $(this).removeClass('is-invalid');
      $(this).parent().removeClass('has-error');
      $(this).parent().parent().removeClass('has-error');
   });

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]','input[type=number]','input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea','select'].join(', '),
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
            $input.parent().parent().addClass('has-error');
            $input.addClass('is-invalid');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
@append

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Payment Details</h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


  <div class="row">
            <aside class="col-sm-6 offset-3">
                <article class="card">
                    <div class="card-body p-5">
                        <!--<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                                <i class="fa fa-credit-card"></i> Credit Card</a>
                            </li>
                        </ul>-->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-tab-card">
                                @foreach (['danger', 'success'] as $status)
                                    @if(Session::has($status))
                                        <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                                    @endif
                                @endforeach
                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>
                                <form
                                        role="form"
                                        action="{{ route('addCardPost') }}"
                                        method="post"
                                        class="require-validation"
                                        data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                        id="payment-form">
                                    @csrf
                                <div class='form-row row'>
                                  <div class="col-sm-12 form-group required">
                                        <label for="username">Full name (on the card)</label>
                                        <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class='form-row row'>
                                    <div class="col-sm-12 form-group card_num required">
                                        <label for="cardNumber">Card number</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete='off' class="form-control card-number" name="cardNumber" placeholder="Card Number">
                                           <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                                <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                                <i class="fab fa-cc-mastercard fa-lg"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group expiration required">
                                                <label><span class="hidden-xs">Expiration</span> </label>
                                                <div class="input-group">
                                                    <select class="form-control card-expiry-month" name="month">
                                                        <option value="">MM</option>
                                                        @foreach(range(1, 12) as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select class="form-control card-expiry-year" name="year">
                                                        <option value="">YYYY</option>
                                                        @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                            <option value="{{$year}}">{{$year}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group cvc required">
                                                <label data-toggle="tooltip" title=""
                                                    data-original-title="3 digits code on back side of the card">CVV <i
                                                    class="fa fa-question-circle"></i></label>
                                                <input type="number" class="form-control card-cvc" placeholder="ex. 311" name="cvv">
                                            </div>
                                        </div>
                                    </div>

                                    <button class="subscribe btn btn-primary btn-block" type="submit"> Add Card </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </aside>
        </div>

@endsection
