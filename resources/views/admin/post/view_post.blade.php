@extends('layouts.admin_layout.admin_layout')
@section('content')
<style>
  .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
     .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
      }

      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }

      .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }

      input:checked + .slider {
        background-color: #2196F3;
      }

      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }
       input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      /* Rounded sliders */
      /.slider.round {
        border-radius: 34px;
      }

      .slider.round:before {
        border-radius: 50%;
      }
</style> 
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
      @error('category_id')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror  
      @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 

      @error('price')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror   
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Place</h3>
              <a href="{{route('admin.add.edit.post')}}" style="width: auto; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add New  Post</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Place Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                    ?>
                @forelse($post as $item)
                <tr>
                    <td>{{$i}}</td>
                    <?php $i++; ?>
                    <td>{{$item->title}}</td>
                    <td>
                        @if(!empty($item->category->category))
                        {{$item->category->category}}
                        @else
                        No Category
                        @endif
                    </td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->details}}</td>
                    <td><img src="{{asset($item->image)}}" alt="" with="100" height="100" srcset=""></td>
                      <td style="">
                        {{-- <label class="switch" style="">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label> --}}
                        @if($item->status==1)
                          <a  class="updatePostStatus" id="post-{{$item->id}}" post_id="{{$item->id}}"  href="javascript:(0);">Active</i></a>
                        @else
                        <a class="updatePostStatus" id="post-{{$item->id}}" post_id="{{$item->id}}" href="javascript:(0);">Inactive</a>
                        @endif
                      </td>
                    </td>
                    <td>
                    <a href="{{route('admin.add.edit.post', $item->id)}}"> <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.post.images', $item->id)}}"> <i class="fas fa-image"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="post" rel="{{$item->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
             
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

