@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catalogues</li>
            </ol>
          </div>
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
    @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">{{ $title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
          </div>
        </div>
        {{-- <form
        @if(!empty($saledata['id'])) action="{{route('admin.add.edit.sale',$saledata['id'])}}" @else action="{{route('admin.add.edit.sale')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf --}}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                     
                      <label for="name">Waiter</label>
                      <select class="form-control" id="name">
                        @forelse($waiter as $data)
                        <option>{{ $data->name }}</option>
                        @empty
                        @endforelse
                      </select>
                    </div>
             </div> 

           
             <div class="col-md-4">
                    <div class="form-group">
                      <label for="customer_name">Customer</label>
                      <select class="form-control" id="customer_name">
                        @forelse($customer as $data)
                        <option>{{ $data->customer_name }}</option>@empty
                        @endforelse
                      </select> 
                    </div>
             </div>
                </div>
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Sales</h3>
                          <div class="card-body">
                            <span id="add_item">
                              @include('admin.sale.ajax_food_table')
                            </span>
                          </div>
<button class="btn btn-primary">PlaceOrder</button><br>

                        </div>
                      </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <li class="nav-item dropdown" style="">
                    <i  class="btn btn-primary">All</i>
                      
                      <a class="nav-link" data-toggle="dropdown" href="#">
      
                        <i  class="btn btn-primary">Category</i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      @forelse($foodCategories as $data)
                        <a href="javascript:" class="dropdown-item categories" attr={{$data->id}} >{{$data->category_name}}
                        </a>
                        @empty
                      @endforelse
                      </div>
                    </li>
                </div>
               <span id="ajaxItem">
                 @include('admin.sale.ajaxItem')
               </span>
          </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{$button}}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
@endsection

