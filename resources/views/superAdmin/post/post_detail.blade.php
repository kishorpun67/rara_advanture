@extends('layouts.superAdmin_layout.superAdmin_layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="content-header"></div>
        </div>

    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Name:</b> <a class="float-center">{{$postDetails->admin->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Title:</b> <a class="float-center">{{$postDetails->title}}</a>
                </li>
                <li class="list-group-item">
                  <b>Category:</b> <a class="float-center">{{$postDetails->category->category}}</a>
                </li>
                <li class="list-group-item">
                    <b>Type:</b> <a class="float-center">{{$postDetails->title}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Price:</b> <a class="float-center">{{$postDetails->price}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Price Type:</b> <a class="float-center">{{$postDetails->price_type}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Ad Duration:</b> <a class="float-center">{{$postDetails->expire_days}} days</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status:</b> <a class="float-center"> {{$postDetails->confirm_status}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Image:  </b> <a class="float-center"><img src="{{asset($postDetails->image)}}" alt="" srcset="" alt="imag" width="200" height="200"></a>
                  </li>
                  <li class="list-group-item">
                    <b>Description:</b> <a class="float-center">{{$postDetails->details}}</a>
                  </li>
                  {{-- <li class="list-group-item"> --}}
                    {{-- <b>Category</b> <a class="float-right">13,287</a> --}}
                  {{-- </li> --}}
                  {{-- <li class="list-group-item"> --}}
                    {{-- <b>Category</b> <a class="float-right">13,287</a> --}}
                  {{-- </li> --}}
                
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Update Status</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>
            <form  action="{{ route('superAdmin.post.update.status', $postDetails->id) }}"   method="post" enctype="multipart/form-data">
            @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="category">Select Status*</label>
                      <select name="confirm_status" id="" class="form-control form-control-sm">
                        <option value="">Select</option>
                        <option value="New"
                        @if (!empty($postDetails->confirm_status) && $postDetails->confirm_status == "New")
                          selected =""
                        @endif
                        >New</option>
                        <option value="Pending"
                        @if (!empty($postDetails->confirm_status) && $postDetails->confirm_status == "Pending")
                        selected =""
                      @endif
                      >Pending</option>
                        <option value="Confirmed"
                        @if (!empty($postDetails->confirm_status) && $postDetails->confirm_status == "Confirmed")
                        selected =""
                      @endif
                      >Confirmed</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

</section>
</div>
@endsection