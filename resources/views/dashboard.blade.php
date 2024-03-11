@extends('layouts.app')
@section('title') {{'Dashboard'}} @endsection

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <h3 class="text-muted">Credit Balance</h3>
        <p class="text-muted">Total skip traces left in your account.</p>
      </h3>
    </div>
      <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

       <h2>{{$total_skips}}</h2>
      </div>
   </div>
 </div>
</div>

<!-- /.content -->
</section>
@endsection
