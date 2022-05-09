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
        <form
        @if(!empty($foodMenusData['id'])) action="{{route('admin.add.edit.food.menu',$foodMenusData['id'])}}" @else action="{{route('admin.add.edit.food.menu')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                  @if(!empty($foodMenusData['name']))
                  value= "{{$foodMenusData['name']}}"
                  @else value="{{old('name')}}"
                  @endif>
                </div>

                <div class="form-group">
                <label for="sale_price">Sale Price</label>
                  <input type="text" class="form-control" name="sale_price" id="sale_price" placeholder="Enter sale price"
                  @if(!empty($foodMenusData['sale_price']))
                  value= "{{$foodMenusData['sale_price']}}"
                  @else value="{{old('sale_price')}}"
                  @endif>
                </div>

              
                <div class="form-group">
                    <label for="category_id">Ingredient Food Category</label>
                    <select name="category_id" id="category_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($foodCategory as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($foodMenusData['category_id']) && $foodMenusData['category_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->category_name}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" cols="20" class="form-control" rows="4"> @if(!empty($foodMenusData['description']))
                    {{$foodMenusData['description']}}
                    @else {{old('description')}}
                    @endif</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" @if(!empty($foodMenusData['image']))
                  value= "{{$foodMenusData['image']}}"
                  @else value="{{old('image')}}"
                  @endif><br>
                  @if(!empty($foodMenusData['image']))
                    <img src="{{asset($foodMenusData['image'])}}" width="100" height="100" alt="" srcset="">
                  @endif
                </div>

                  
                <div class="form-group">
                    <label for="ingredient_id">Ingredient Food</label>
                    <select name="ingredient_id" id="ingredient_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($ingredientUnit as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($foodMenusData['ingredient_id']) && $foodMenusData['ingredient_id'] == $data->id)
                                  selected=""
                              @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->unit_name}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>
                  </div>

                    <div class="form-group">
                        <label for="code">Code</label>
                          <input type="text" class="form-control" name="code" id="code" placeholder="Enter sale price"
                          @if(!empty($foodMenusData['code']))
                          value= "{{$foodMenusData['code']}}"
                          @else value="{{old('code')}}"
                          @endif>
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

