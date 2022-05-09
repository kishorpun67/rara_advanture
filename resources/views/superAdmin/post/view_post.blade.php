@extends('layouts.superAdmin_layout.superAdmin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
          @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @error('email')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @enderror  

    @error('password')
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @enderror  
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Post</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped" style="text-align: center;">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->category->category}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->details}}</td>
                    <td><p class="primary">{{$post->confirm_status}}</p></td>
                    <td>
                    <a href="{{route('superAdmin.post.detail', $post->id)}}"> <i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="post" rel="{{$post->id}}" style="display:inline;">
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
  // $(document).ready(function() {
  //      $('.ckeditor').ckeditor();
  //   });
</script>
@endsection

