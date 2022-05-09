@extends('layouts.superAdmin_layout.superAdmin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View banner</h3>
              <a href="" data-toggle="modal" data-target="#myModals" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add banner</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>First Title</th>
                  <th>Second Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Satus</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($banner as $banner)
                <tr>
                    <td>{{$banner->id}}</td>
                    <td>{{$banner->title_first}}</td>
                    <td>{{$banner->title_second}}</td>
                    <td>{{$banner->description}}</td>
                    <td><img src="{{asset($banner->image)}}" alt="" with="100" height="100" srcset=""></td>
                    <td>
                      @if($banner->status==1)
                        <a  class="updateBannerStatus" id="banner-{{$banner->id}}" banner_id="{{$banner->id}}"  href="javascript:(0);">Active</a>
                      @else
                      <a class="updateBannerStatus" id="banner-{{$banner->id}}" banner_id="{{$banner->id}}" href="javascript:(0);">Inactive</a>
                      @endif
                  </td>
                    <td>
                    <a href=""data-toggle="modal" data-target="#myModal{{$banner->id}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="banner" rel="{{$banner->id}}" style="display:inline;">
                    <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                <div class="modal fade" id="myModal{{$banner->id}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form  method="POST"   action="{{route('superAdmin.edit.banner',$banner->id)}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="class">First Title</label>
                                    <input type="text" name="title_first" class="form-control" value="{{$banner->title_first}}">
                                    <label for="class">Second Title</label>
                                    <input type="text" name="title_second" class="form-control" value="{{$banner->title_second}}">
                                    <label for="class">Description </label>
                                    <textarea name="description" id="" class="form-control" cols="30" rows="10">{{$banner->description}}</textarea>
                                    <label for="class"> Image</label>
                                    <input type="file" name="image" class="form-control" id="">
                                    <br>
                                    @if($banner->image)
                                      <input type="hidden"  name="old_image" value="{{$banner->image}}">
                                      <img src="{{asset($banner->image)}}" width="450" height="200" alt="" srcset="">
                                    @endif
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="myModals">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form  method="POST"   action="{{route('superAdmin.add.banner')}}"  enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="class">First Title</label>
                  <input type="text" name="title_first" class="form-control" placeholder="First Title">
                  <label for="class">Second Title</label>
                  <input type="text" name="title_second" class="form-control" placeholder="Second Title">
                  <label for="class">Description </label>
                  <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                    <label for="description">Image</label>
                    <input type="file" name="image" class="form-control" id="">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>

  $(function () {
    $("#categories").DataTable();

  });
  $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection

