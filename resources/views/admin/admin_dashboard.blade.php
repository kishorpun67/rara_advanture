 @extends('layouts.admin_layout.admin_layout')
@section('content')
<?php 
use App\OrderDetail;
use App\User;
USE App\Admin\Post;
if(auth('admin')->user()->parent_id > 0){
      $admin_id = auth('admin')->user()->parent_id;
  }else{
      $admin_id = auth('admin')->user()->id;
  }

$posts = Post::where('admin_id', $admin_id)->count();
// $user = User::count();
// $total_order = OrderDetail::where('admin_id', $admin_id)->sum('quantity');




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
          <div class="col-lg-3 col-6">
            {{-- <iframe src="https://www.hamropatro.com/widgets/calender-small.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:200px; height:290px;" allowtransparency="true"></iframe> --}}
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Post</h3>
                <p>{{number_format($posts)}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>



</div>
<!-- /.content-wrapper -->

@endsection
