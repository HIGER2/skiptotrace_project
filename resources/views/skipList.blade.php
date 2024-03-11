@extends('layouts.app')

@section('title') {{'Skip List'}} @endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('auth/plugins/toastr/toastr.min.css')}}">

@append

@section('js')

<!-- AdminLTE for demo purposes -->
<script src="{{asset('auth/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('auth/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">></script>
<script src="{{asset('auth/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">></script>

<script type="text/javascript" src="{{asset('auth/plugins/toastr/toastr.min.js')}}"></script>


<!-- bs-custom-file-input -->
<script src="{{asset('auth/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('auth/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

<script>
  jQuery(function ($) {
    $("#mylist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    });


  bsCustomFileInput.init();

  var skip_total=$('.total_skips').val();
  if(skip_total == 0){
      $('#modal-info').modal('show');
  }

 $('#skip_csv').validate({
    rules: {
      csvfile: {
        required: true,
      }
    },
    messages: {
      csvfile: {
        required: "Please upload file"
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


 $(".delete_csv").click(function(){
     var id = $(this).data("csv_id");
     var filename = $(this).data("filename");
     $(".csv_id_del").val(id);
     $(".csv_filename_del").val(filename);
     $('#modal-confirmation').modal('show');
 });

  $(".yes_delete").click(function(){
    var id = $(".csv_id_del").val();
    var filename = $(".csv_filename_del").val();
    $('.loading-image').css("display","block");
    //console.log(card_id +"= "+ token);
    $.ajaxSetup({
       headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
    $.ajax({
        url: "skipList",
        type: 'POST',
        dataType: "JSON",
        data: {
            "id": id,
            "filename": filename,
            "type": "delete",
        },
        success: function (response)
        {
          //console.log(response.status);
          if(response.status ==1){
            $("#row_"+id).remove();
            $('#modal-confirmation').modal('hide');
            toastr.success(response.msg)
          }
          else{
            $('#modal-confirmation').modal('hide');
            toastr.error(response.msg);
          }
        },
        complete: function(){
          $('.loading-image').css("display","none");
        }
    });
  });

  /*$(".run_skips").click(function(){
      var id = $(this).data("csv_id");
      var filename = $(this).data("filename");
      $(".csv_filename").val(filename);
      $(".csv_id").val(id);
      $('#modal-confirmationSkip').modal('show');
  });

  $(".yes_skips").click(function(){
    var id = $(".csv_id").val();
    var filename = $(".csv_filename").val();
    $('.loading-image').css("display","block");
    //console.log(card_id +"= "+ token);
    $.ajaxSetup({
       headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
    $.ajax({
        url: "skipList",
        type: 'POST',
        dataType: "JSON",
        data: {
            "id": id,
            "filename": filename,
            "type": "import",
        },
        success: function (response)
        {
          console.log(response);
        },
        complete: function(){
          $('.loading-image').css("display","none");
        }
    });
  });*/

});
</script>

@append

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12">
        <h1 class="m-0">Import Skip CSV</h1>
        <div class="callout callout-info mt-4">
              <h5>CSV format sample</h5>
              <p class="csv_format_p">First name, Last name, Address, City, State, Zipcode</p>
              <p>You can download sample file from here : <a href="{{asset('Skiptracing.csv')}}">Skip Tracing</a></p>
          </div>
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
              @if ( $errors->count() > 0 )
              <p class="error_title">The following errors have occurred:</p>

              <ul>
                @foreach( $errors->all() as $message )
                  <li>{{ $message }}</li>
                @endforeach
              </ul>
            @endif
            @if (isset($custom_error))
            <p class="alert alert-danger">{{ $custom_error }}</p>
            @endif
          </div>

          @foreach (['danger', 'success'] as $status)
              @if(Session::has($status))
                  <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
              @endif
          @endforeach

          <!-- form start -->
          <form action="{{ url('/skipList') }}" method="post" enctype="multipart/form-data" class="require-validation" id="skip_csv" >

            {{ csrf_field() }}

            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputFile"></label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="csvfile" class="custom-file-input" id="csv_InputFile" accept=".csv">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>

              <div class="msg error invalid-feedback" style="display:block;"></div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="form-group">
                <input type="hidden" name="total_skips" class="form-control total_skips" value="{{$total_skips}}">
                <input type="hidden" name="type" value="upload" />
                <button type="submit" class="btn btn-primary">Upload CSV</button>
              </div>
            </div>

          </form>
        </div>
        <!-- /.card -->


        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Pending CSV File List</h1>
              </div><!-- /.col -->

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <div class="card">
          @if(isset($csv_data))
          <div class="card-body">
            <table id="mylist" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>CSV FIle</th>
                <th>Total CSV Records</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($csv_data as $data)
                  <tr id="row_{{$data->id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->file_name}}</td>
                    <td>{{$data->total_records}}</td>
                    <td>{{$data->date}}</td>
                    <td>
                      <form action="{{ url('/skipList') }}" method="post">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$data->id}}"/>
                        <input type="hidden" name="filename" value="{{$data->file_name}}"/>
                        <input type="hidden" name="total_skips" value="{{$total_skips}}"/>
                        <input type="hidden" name="total_records" value="{{$data->total_records}}"/>
                        <input type="hidden" name="type" value="import"/>

                      <button type="submit" class="btn btn-block btn-info run_skips">Run Skips</button>
                      </form>
                      <button type="button" class="btn btn-block btn-danger delete_csv" data-csv_id="{{$data->id}}"
                        data-filename="{{$data->file_name}}">Delete</button>
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
        <p></p>

      </div>
      </div>
    </section>

  <!-- info Modal -->
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
                  <button type="button" class="btn btn-default"><a href="/add_credits">Ok</a></button>
               </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

    <!-- Delete Modal -->
          <div class="modal fade show" id="modal-confirmation" aria-modal="true" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Delete CSV Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure, this csv file will delete permanently from system!</p>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" name="csv_id" class="csv_id_del" />
                        <input type="hidden" name="csv_filename" class="csv_filename_del" />

                        <i class="fa fa-cog fa-spin loading-image" style="font-size:24px; display:none;"></i>
                        <button type="button" class="btn btn-primary yes_delete">Yes</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

                <!-- Info  Modal -->
                      <div class="modal fade show" id="modal-confirmationSkip" aria-modal="true" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">CSV Records</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure, you want to run skips !</p>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <input type="hidden" name="csv_id" class="csv_id" />
                                    <input type="hidden" name="csv_filename" class="csv_filename" />

                                    <i class="fa fa-cog fa-spin loading-image" style="font-size:24px; display:none;"></i>
                                    <button type="button" class="btn btn-primary yes_skips">Yes</button>
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

@endsection
