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
                    <h3 class="card-title">View tourType</h3>
                    <a href="" data-toggle="modal" data-target="#myModals-add" style="width: auto; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add tourType</a>
                </div>
                <div class="card-body">
                    <table id="categories" class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                    @forelse($tourType as $tourType)
                    <tr>
                        <td>{{$i}}</td>
                        <?php  $i++;?>
                        <td>{{$tourType->icon}}</td>
                        <td>{{$tourType->type}}</td>
                        <td>
                        <a href=""data-toggle="modal" data-target="#myModal{{$tourType->id}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:" class="delete_form" record="tour-type" rel="{{$tourType->id}}" style="display:inline;">
                            <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                        </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="myModal{{$tourType->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <form  method="POST"   action="{{route('superAdmin.add.edit.tour.type',$tourType->id)}}"  enctype="multipart/form-data" id="quickFor">
                                @csrf
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <label for="class"> Icon</label>
                                    <input type="text" name="icon" id="" class="form-control" required value="{{$tourType->icon}}">
                                    <label for="">Type</label>
                                    <input type="text" name="type" id="" class="form-control"  value="{{$tourType->type}}">
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
        <div class="modal fade" id="myModals-add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <form  method="POST"   action="{{route('superAdmin.add.edit.tour.type')}}"  enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="class"> Icon</label>
                    <input type="text" name="icon" id="" class="form-control" required>
                    <label for="">Type</label>
                    <input type="text" name="type" id="" class="form-control"  value="">
                    
                   
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
        // $(document).ready(function() {
        //      $('.ckeditor').ckeditor();
        //   });
    </script>
    @endsection
    
