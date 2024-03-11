@extends('layouts.app')

@section('title') {{'Manage Cards'}} @endsection

@section('css')
<link rel="stylesheet" href="{{asset('auth/plugins/toastr/toastr.min.css')}}">

<style>
.btn-group{
  margin:6% 0;
}
.bg-gradient-danger{
  margin-top: 0 !important;
}
</style>
@append

@section('js')
<!-- Bootstrap 4 -->
<script src="{{asset('auth/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SweetAlert2 -->
<script type="text/javascript" src="{{asset('auth/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">

$(function() {

       $(".dalete_card").click(function(){
            var id = $(this).data("card_id");
            var last4 = $(this).data("last4");
            $(".card_last4").text(last4);
            $(".card_id").val(id);
            $('#modal-confirmation').modal('show');
        });

        $(".delete_yes").click(function(){
          var card_id = $('.card_id').val();
          var token = $(this).data("token");
          var card_last4=$(".card_last4").text();
          $('#loading-image').show();
          //console.log(card_id +"= "+ token);
          $.ajaxSetup({
             headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
          });
          $.ajax({
              url: "deleteCard",
              type: 'POST',
              dataType: "JSON",
              data: {
                  "card_id": card_id
              },
              success: function (response)
              {
                //console.log(response.status);
                if(response.status ==1){
                  $("#row_"+card_id).remove();
                  $('#modal-confirmation').modal('hide');
                  toastr.success(card_last4+" "+response.msg)
                }
                else{
                  $('#modal-confirmation').modal('hide');
                  toastr.error(response.msg);
                }
              },
              complete: function(){
                  $('#loading-image').hide();
              }
          });
        });

        $(".edit_card").click(function(){
             var id = $(this).data("card_id");
             var last4 = $(this).data("last4");
             $(".edit_card_last4").text(last4);
             $(".edit_card_id").val(id);
             $('#modal_edit').modal('show');
         });

         $(".edit_yes").click(function(){
           var card_id = $('.edit_card_id').val();
           var card_last4=$(".edit_card_last4").text();
           var expiry_month=$('.card-expiry-month').val();
           var expiry_year=$('.card-expiry-year').val();
           //console.log(card_id + expiry_month + expiry_year);
          if(expiry_month == 0 ){
            $(".msg").html("Please select at least One option for expiry month");
          }
          else if( expiry_year == 0){
            $(".msg").html("Please select at least One option for expiry year");
          }
          else{
            $(".msg").html('');
            $('#edit_loading-image').show();
            //console.log(card_id +"= "+ token);
            $.ajaxSetup({
               headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
            $.ajax({
                url: "editCard",
                type: 'POST',
                dataType: "JSON",
                data: {
                    "card_id": card_id,
                    "expiry_month" : expiry_month,
                    "expiry_year" : expiry_year
                },
                success: function (response)
                {
                  //console.log(response);
                  $('.card-expiry-month').val(0);
                  $('.card-expiry-year').val(0);
                  if(response.status ==1){
                    $("#row_"+card_id).find('.expire_info').text(response.info);
                    $('#modal_edit').modal('hide');
                    toastr.success(card_last4+" "+response.msg)
                  }
                  else{
                    $('#modal_edit').modal('hide');
                    toastr.error(response.msg);
                  }
                },
                complete: function(){
                    $('#edit_loading-image').hide();
                }
            });
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
        <h1 class="m-0">List of All saved card</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
      <div class="container-fluid">
        @if ( $errors->count() > 0 )
          @foreach( $errors->all() as $message )
          <p class="alert alert-danger">{{ $message }}</p>
          @endforeach
      @endif

@if(isset($cards))

    <div class="row">
        @foreach($cards as $data)
          <div class="col-md-4 col-sm-6 col-12" id=row_{{$data->id}}>
            <div class="info-box">

              <div class="info-box-content">
                <span class="info-box-text">XXXX XXXX XXXX {{$data->last4}}</span>
                <span class="info-box-number expire_info">Expires {{$data->exp_month}}/{{$data->exp_year}}</span>
                <span class="info-box-text">
                  @if($data->brand == "Visa")
                    <img src="{{asset('auth/dist/img/credit/visa.png')}}" title="{{$data->brand}}"/>
                    {{$data->brand}}
                  @elseif($data->brand == "MasterCard")
                    <img src="{{asset('auth/dist/img/credit/mastercard.png')}}" title="{{$data->brand}}"/>
                    {{$data->brand}}
                  @elseif($data->brand == "American Express")
                    <img src="{{asset('auth/dist/img/credit/american-express.png')}}" title="{{$data->brand}}"/>
                    {{$data->brand}}
                  @else
                    {{$data->brand}}
                  @endif
                </span>
                <span class="info-box-number">{{$data->funding}}</span>
                <div class="progress">
                  <div class="progress-bar1" style="width: 100%"></div>
                </div>
                <div class="btn-group w-100">
                  <button type="button" class="btn btn-block bg-gradient-info edit_card" data-card_id="{{$data->id}}" data-last4="{{$data->last4}}">Edit</button>
                  <button type="button" class="btn btn-block bg-gradient-danger dalete_card" data-card_id="{{$data->id}}" data-last4="{{$data->last4}}">Delete</button>
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         @endforeach
        </div>
        @endif

      </div>
    </section>

    <div class="modal fade show" id="modal-confirmation" aria-modal="true" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Delete Card</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete card XXXX XXXX XXXX <span class="card_last4"></span>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  <i class="fa fa-cog fa-spin" id="loading-image" style="font-size:24px; display:none;"></i>
                  <button type="button" class="btn btn-primary delete_yes" data-token="{{ csrf_token() }}">Yes</button>
                  <input type="hidden" class="card_id" >
               </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

          <div class="modal fade show" id="modal_edit" aria-modal="true" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Card XXXX XXXX XXXX <span class="edit_card_last4"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group expiration required">
                                    <label><span class="hidden-xs">Expiration</span> </label>
                                    <div class="input-group">
                                        <select class="form-control card-expiry-month" name="month">
                                            <option value="0">MM</option>
                                            @foreach(range(1, 12) as $month)
                                                <option value="{{$month}}">{{$month}}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-control card-expiry-year" name="year">
                                            <option value="0">YYYY</option>
                                            @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="msg error invalid-feedback" style="display:block;"></div>
                                </div>
                            </div>

                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <i class="fa fa-cog fa-spin" id="edit_loading-image" style="font-size:24px; display:none;"></i>
                        <button type="button" class="btn btn-primary edit_yes" data-token="{{ csrf_token() }}">Yes</button>
                        <input type="hidden" class="edit_card_id" >
                     </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>


@endsection
