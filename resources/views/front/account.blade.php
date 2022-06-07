@extends('layouts.front_layout.front_layout')
@section('content')

<!-- ./Main slider starts-->

<section class="banner_slider subpage-slider">
 <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
 <div class="breadCrumbNav">
   <div class="container breadcrumb-container">
     <h1 class="breadCrumb_title"> User Profile</h1>
     <div class="breadcumb-inner">
       <ul>
         <li><a href="{{route('home')}}" class="breadCrumb_link">HOME</a></li>
         <li><span>Account</span></li>
       </ul>
     </div>
   </div>
 </div>
</section>
<section class="vertical-tab-section">
    <div class="container tab-container">
        <div class="row">
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
            <div class="col-3 col-sm-3 col-xs-3">
                {{-- <h4 class="tab-heading">TOUR CATEGORIES</h4> --}}
                <ul class="nav nav-tabs tabs-left">
                    <li class="active"><a href="#dashboard" data-toggle="tab"><i class="fa fa-tachometer" aria-hidden="true"></i>
                        Dashboard</a></li>
                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>
                        Profile</a></li>
                    <li><a href="#history" data-toggle="tab"><i class="fas fa-history"></i> History</a></li>
                    <li><a href="#order" data-toggle="tab"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Order</a></li>
                    <li><a href="{{route('logout')}}" ><i class="fa fa-sign-out" aria-hidden="true"></i>
                        Logout</a></li>

                </ul>
            </div>
            <div class="col-9 col-sm-9 col-xs-9 ">
                {{-- <h4 class="tab-heading">TOUR DETAILS</h4> --}}
                    <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="dashboard">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, eum ipsam! Maxime iure, et facere libero ducimus dolore pariatur animi consequuntur dolores nesciunt, voluptas numquam tempora eligendi dicta? Deserunt, eligendi!</p>
                    </div>
                    <div class="tab-pane" id="profile">
                        <div class="row">
                            <div class="col col-sm-6">
                              <div class="login_form">
                                <h3>Update User Password</h3>
                                <form action="{{route('update.user.password')}}" method="post">
                                      @csrf
                                  <div class="form-group">
                                    <input type="password" class="form-control" name="current_password" placeholder="Current Password" required>
                                  </div>
                                  <div class="form-group">
                                    <input type="password" class="form-control" name="new_password"  placeholder="New Password" required>
                                  </div>
                                  <div class="form-group">
                                    <input type="password" class="form-control" name="confirm_password"  placeholder="Confirm Password" required>
                                  </div>
                                  
                                  <button type="submit" class="btn submit-btn btn-login">Update</button>
                                  <div class="form-group"> </div>
                                </form>
                              </div>
                            </div>
                            <div class="col col-sm-6">
                              <div class="register_form">
                                <h3>Update User Details</h3>
                                <form action="{{route('update.user.detail')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="" value="{{auth()->user()->email}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Full Name" @if (!empty(auth()->user()->name))
                                        value="{{auth()->user()->name}}"
                                        @else
                                            value="{{old('name')}}"
                                        @endif ">
                                        <p style="color: red">
                                            @error('name')
                                                {{$message}}
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="number" placeholder="Number" 
                                        @if (!empty(auth()->user()->number))
                                        value="{{auth()->user()->number}}"
                                        @else
                                            value="{{old('number')}}"
                                        @endif >
                                        <p style="color: red">
                                            @error('number')
                                                {{$message}}
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" placeholder="Address" 
                                        @if (!empty(auth()->user()->address))
                                        value="{{auth()->user()->address}}"
                                        @else
                                            value="{{old('address')}}"
                                        @endif>
                                        <p style="color: red">
                                            @error('address')
                                                {{$message}}
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image"> 
                                        <p style="color: red">
                                            @error('image')
                                                {{$message}}
                                            @enderror
                                        </p>


                                        @if (!empty(auth()->user()->image))
                                           <a href="{{asset(auth()->user()->image)}}">View Image</a>
                                        @endif
                                    </div>
                      
                                  <div class="form-group">
                                    <button type="submit" class="btn submit-btn btn-login">Update</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="history">History</div>
                    <div class="tab-pane" id="order">
                      <h3>Order</h3>
                      <table>
                        <thead>
                          <tr>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($order as $item)
                              <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->total}}</td>
                                <th style="text-align: center; padding:8px 0;"><a href="" data-toggle="modal" data-target="#myModal{{$item->id}}" class="btn btn-danger">View</a></th>
                              </tr>
                           
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($order as $item)

{{-- <div class="modal fade" id="myModal{{$item->id}}">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>SN</th>
              <th>Place</th>
              <th>Price</th>
              <th>Start Date</th>
              <th>End Date</th>
            </tr>
          </thead>
          <tbody>
            @if (!empty($item->orderDetails ))
              @foreach ($item->orderDetails as $orderdetails)
             <tr>
              <td>{{$orderdetails->id}}</td>
              <td>{{$orderdetails->title}}</td>
              <td>{{$orderdetails->price}}</td>
              <td>{{$orderdetails->checkin}}</td>
              <td>{{$orderdetails->checkout}}</td>
             </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div --}}
@endforeach
</section>

@endsection
