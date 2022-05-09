 @extends('layouts.superAdmin_layout.superAdmin_layout')
@section('content')
<?php 
use App\OrderDetail;
use App\User;


$total = OrderDetail::sum('total');
$user = User::count();
$total_order = OrderDetail::sum('quantity');
$cancel_order = OrderDetail::where('cancel', 0)->sum('quantity');
$cancel_sales = OrderDetail::where('cancel', 0)->sum('total');




?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
        </div>
      </div>
    </section>



</div>
<!-- /.content-wrapper -->

@endsection
