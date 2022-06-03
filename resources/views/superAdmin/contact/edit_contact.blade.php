@extends('layouts.superAdmin_layout.superAdmin_layout')
@section('content')

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
          <h3 class="card-title">Contact</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
          </div>
        </div>
        <form
        @if(!empty($contact['id'])) action="{{route('superAdmin.edit.contact',$contact['id'])}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Address *</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Address " autocomplete=""  required
                  @if(!empty($contact['address']))
                  value= "{{$contact['address']}}"
                  @else value="{{old('address')}}"
                  @endif>
                </div>
                <div class="form-group">
                    <label for="mobile"> Mobile *</label>
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder=""  required
                    @if(!empty($contact['mobile']))
                    value= "{{$contact['mobile']}}"
                    @else value="{{old('mobile')}}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="hot_line">Hot Line </label>
                    <input type="text" class="form-control" name="hot_line" id="hot_line" placeholder="Hot Line"  
                    @if(!empty($contact['hot_line']))
                    value= "{{$contact['hot_line']}}"
                    @else value="{{old('hot_line')}}"
                    @endif>
                  </div>
                  <div class="form-group">
                    <label for="instagram">Instagram </label>
                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder=" Instagram "  
                    @if(!empty($contact['instagram']))
                    value= "{{$contact['instagram']}}"
                    @else value="{{old('instagram')}}"
                    @endif>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="twitter">Twitter </label>
                    <input type="text" class="form-control" name="twiter" id="twiter" placeholder=" Twitter "  
                    @if(!empty($contact['twiter']))
                    value= "{{$contact['twiter']}}"
                    @else value="{{old('twiter')}}"
                    @endif>
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook </label>
                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder=" Facebook "  
                        @if(!empty($contact['facebook']))
                        value= "{{$contact['facebook']}}"
                        @else value="{{old('facebook')}}"
                        @endif>
                    </div>
                <div class="form-group">
                    <label for="gmail">Email * </label>
                    <input type="text" class="form-control" name="gmail" id="gmail" placeholder=" Email "  required
                    @if(!empty($contact['gmail']))
                    value= "{{$contact['gmail']}}"
                    @else value="{{old('gmail')}}"
                    @endif>
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
  </section>
</div>
@endsection

