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
        @if(!empty($purchasedata['id'])) action="{{route('admin.add.edit.purchase',$purchasedata['id'])}}" @else action="{{route('admin.add.edit.purchase')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
 
                  <label for="supplier_id">Supplier Name</label>
                  <select name="supplier_id" id="supplier_id" class="form-control" >
                      <option value="" >Select</option>
                      @forelse($supplier as $data)
                              <option value="{{$data->id}}"
                                @if (!empty($purchasedata['supplier_id']) && $purchasedata['supplier_id'] == $data->id)
                                    selected=""
                                @endif
                                  >&nbsp;&raquo;&nbsp; {{$data->name}}
                              </option>
                              
                      @empty
                      @endforelse

                  </select>

                  
                </div>


                <div class="form-group">
                <label for="date">Date</label>
                  <input type="date" class="form-control" name="date" id="date"
                  @if(!empty($purchasedata['date']))
                  value= "{{$purchasedata['date']}}"
                  @else value="{{old('date')}}"
                  @endif>
                </div>

              
                <div class="form-group">
                    <label for="ingredient_id">Ingredient Category</label>
                    <select name="ingredient_id" id="ingredient_id" class="form-control " >
                        <option value="" >Select</option>
                        @forelse($ingredientCategory as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($purchasedata['ingredient_id']) && $purchasedata['ingredient_id'] == $data->id)
                                      selected=""
                                  @endif
                                    >&nbsp;&raquo;&nbsp; {{$data->category}}
                                </option>
                                
                        @empty
                        @endforelse
                    </select>

                  </div>

                  <div class="form-group">
                    <label for="unit_id">Ingredient Unit</label>
                    <select name="unit_id" id="unit_id" class="form-control form-control-sm " >
                        <option value="" >Select</option>
                        @forelse($ingredientUnit as $data)
                                <option value="{{$data->id}}"
                                  @if (!empty($purchasedata['unit_id']) && $purchasedata['unit_id'] == $data->id)
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
                      <input type="text" class="form-control" name="code" id="code" placeholder="Enter purchase code"
                      @if(!empty($purchasedata['code']))
                      value= "{{$purchasedata['code']}}"
                      @else value="{{old('code')}}"
                      @endif>
                    </div>  
            

                    <div class="form-group">
                        <label for="amount">Amount</label>
                          <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount"
                          @if(!empty($purchasedata['amount']))
                          value= "{{$purchasedata['amount']}}"
                          @else value="{{old('amount')}}"
                          @endif>
                    </div>
               
                </div>
                <div class="col-md-6 ">
                  <a href="" data-toggle="modal" data-target="#myModal"style="max-width: 150px; margin-top:30px; float:left; display:inline-block;"  class="btn btn-primary ">Add</a>
  
                    </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary ">{{$button}}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form
      action="{{route('admin.add.edit.supplier')}}"
      method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label for="name">Name*</label>
                  <input  class="form-control" id="name "name="name" placeholder="Enter name">
                  <label for="address"> Address *</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                  <label for="contact_person">Contact Person*</label>
                  <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter contact">
                  <label for="phone"> Phone *</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                  <label for="address"> Email *</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                  <label for="class">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="6" rows="3"></textarea>
              </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" value="Submit">
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

