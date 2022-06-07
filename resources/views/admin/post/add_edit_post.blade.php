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
        <form
        @if(!empty($postData['id'])) action="{{route('admin.add.edit.post',$postData['id'])}}" @else action="{{route('admin.add.edit.post')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title">Title *</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title"
                  @if(!empty($postData['title']))
                  value= "{{$postData['title']}}"
                  @else value="{{old('title')}}"
                  @endif>
                  <p style="color: red">
                    @error('title')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="class"> Select Category  *</label>
                  <select name="category_id" id="" class="form-control">
                  <option value="" >Select</option>
                    @forelse($categories as $category)
                        <option value="{{$category->id}}"
                            @if(!empty($postData['category_id']) && $postData['category_id']==$category->id)
                            selected=""
                            @else {{ old('category_id') == $category->id ? 'selected' : '' }} 
                            @endif
                            >&nbsp;&raquo;&nbsp; {{$category->category}}
                        </option>
                    @empty
                    @endforelse
                  </select>
                  <p style="color: red">
                    @error('category_id')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="type">Tour Type *</label>
                  <select name="type_id" id="" class="form-control ">
                    <option value="">Select</option>
                    @foreach ($types as $type)
                      <option value="{{$type->id}}"
                        @if (!empty($postData['type_id']) && $postData['type_id'] == $type->id)
                        selected=""
                        @else {{ old('type_id') == $type->id ? 'selected' : '' }} 
                        @endif
                        >{{$type->type}}</option>
                    @endforeach
                  </select>
                  <p style="color: red">
                    @error('type_id')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="class"> Price *</label>
                  <input type="number" class="form-control" name="price" 
                  @if(!empty($postData['price']))
                  value= "{{$postData['price']}}"
                  @else value="{{old('price')}}"
                  @endif>
                  <p style="color: red">
                    @error('price')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="">Appro Tour (days) *</label>
                    <input type="number" class="form-control" name="price_type"  min=1"" placeholder="Enter Day"
                    @if(!empty($postData['price_type']))
                    value= "{{$postData['price_type']}}"
                    @else value="{{old('price_type')}}"
                    @endif>       
                  <p style="color: red">
                    @error('price_type')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="url">Url*</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="Enter Url"
                  @if(!empty($postData['url']))
                  value= "{{$postData['url']}}"
                  @else value="{{old('url')}}"
                  @endif>
                  <p style="color: red">
                    @error('url')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="class">Description</label>
                  <textarea name="description" id="" class="form-control" cols="6" rows="5">@if(!empty($postData['details'])) {{$postData['details']}} @else {{old('details')}} @endif</textarea>
                </div>
                <div class="form-group">
                  <label for="class">Meta Title</label>
                  <textarea name="meta_title" id="" class="form-control" cols="6" rows="3">@if(!empty($postData['meta_title'])) {{$postData['meta_title']}} @else {{old('meta_title')}} @endif</textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date"> Start Date *</label>
                  <input type="date" class="form-control" name="start_date" 
                  @if(!empty($postData['start_date']))
                  value= "{{$postData['start_date']}}"
                  @else value="{{old('start_date')}}"
                  @endif>
                  <p style="color: red">
                    @error('start_date')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="end_date"> End Date *</label>
                  <input type="date" class="form-control" name="end_date" 
                  @if(!empty($postData['end_date']))
                  value= "{{$postData['end_date']}}"
                  @else value="{{old('end_date')}}"
                  @endif>
                  <p style="color: red">
                    @error('end_date')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="form-group">
                  <label for="">How many days do you want your ad to run? *</label>
                  <select name="expire_days" id="" class="form-control ">
                    <option value="">Select</option>
                    <option value="30" @if (!empty($postData['expire_days']) && $postData['expire_days'] == 30) 
                      selected=""
                      @else {{ old('expire_days') == "30" ? 'selected' : '' }} 
                    @endif>One Month</option>
                    <option value="60"  @if (!empty($postData['expire_days']) && $postData['expire_days'] == 60) 
                      selected=""
                      @else {{ old('expire_days') == "60" ? 'selected' : '' }} 

                      @endif>Two Months</option>
                    <option value="90" @if (!empty($postData['expire_days']) && $postData['expire_days'] == 90) 
                    @else {{ old('expire_days') == "90" ? 'selected' : '' }} 

                      selected=""
                      @endif>Three Months</option>
                    <option value="120" @if (!empty($postData['expire_days']) && $postData['expire_days'] == 120) 
                    @else {{ old('expire_days') == "120" ? 'selected' : '' }} 
                      selected=""
                      @endif>Four Months</option>
                    <option value="150" @if (!empty($postData['expire_days']) && $postData['expire_days'] == 150) 
                      selected=""
                      @else {{ old('expire_days') == "150" ? 'selected' : '' }} 
                      @endif>Five Months</option>
                    <option value="180" @if (!empty($postData['expire_days']) && $postData['expire_days'] == 180) 
                      selected=""
                      @else {{ old('expire_days') == "180" ? 'selected' : '' }} 
                      @endif>Six Months</option>
                  </select>
                  <p style="color: red">
                    @error('expire_days')
                        {{$message}}
                    @enderror
                  </p>
                </div>
                <div class="from-group">
                  <label for="class"> Image</label>
                  <input type="file" name="image" class="form-control" id="">
                  <br>
                  @if(!empty($postData['image']))
                    <input type="hidden"  name="old_image" value="{{$postData['image']}}">
                    <img src="{{asset($postData['image'])}}" height="100" width="100" alt="" srcset="">
                  @endif
                </div>
                <div class="form-group">
                  <label for="class">Meta Description</label>
                  <textarea name="meta_description" id="" class="form-control" cols="6" rows="3">@if(!empty($postData['meta_description'])) {{$postData['meta_description']}} @else {{old('meta_description')}} @endif</textarea>
                </div>
                <div class="form-group">
                  <label for="class">Meta Keywords</label>
                  <textarea name="meta_keywords" id="" class="form-control" cols="6" rows="3">@if(!empty($postData['meta_keywords'])) {{$postData['meta_keywords']}}@else {{old('meta_keywords')}}  @endif </textarea>
                </div>
              </div>
            </div>
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

