@extends('layouts.front_layout.front_layout')
@section('content')

<!-- ./Main slider starts-->

<section class="banner_slider subpage-slider">
 <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
 <div class="breadCrumbNav">
   <div class="container breadcrumb-container">
     <h1 class="breadCrumb_title"> Cart Details</h1>
     <div class="breadcumb-inner">
       <ul>
         <li><a href="{{route('home')}}" class="breadCrumb_link">HOME</a></li>
         <li><span>Cart</span></li>
       </ul>
     </div>
   </div>
 </div>
</section>
 
<section class="user-account checkout-details my-5">
    <div class="container tab-container">
        <heading class="section_tittle text-center py-3"> 
         <!--  <p>Our Services</p>-->
        <h1 class="section_title">Checkout</h1>
        </heading>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="new-users">
                    <form id="billing" method="post" action="{{route('checkout')}}">
                        @csrf
                        <div class="col-md-12">
                            <h2>Customer Billing Information</h2>
                        </div>
                        <div class="col-md-6">
                            <label>Full Name * :</label>
                            <input id="" type="text" name="name" class="form-control" value="{{auth()->user()->name}}">
                            <label> Address * :</label>
                            <input id="" type="text" name="address" class="form-control" value="{{auth()->user()->address}}" >
                            <label for="state">Country * :</label>
                            <select name="country" class="form-control select" id="state">
                                    <option value="0">Please Select</option>
                                    @foreach ($countries as $item)
                                        <option value="{{$item->nicename}}" @if (!empty(auth()->user()->country) && 
                                            auth()->user()->country == $item->nicename)
                                            selected =""
                                        @endif>{{$item->nicename}}</option>
                                    @endforeach
                            </select>
                        <button  class="checkout_btn btn">Checkout now</button>
                        </div>
                        <div class="col-md-6">
                            <label>Email * :</label>
                            <input id="" type="text" value="{{auth()->user()->email}}" name="email" class="form-control">
                            <label>Mobile Number * :</label>
                            <input id="" type="text" value="{{auth()->user()->number}}" name="number" class="form-control">
                            <label>City * :</label>
                            <input id="" type="text" value="{{auth()->user()->city}}" name="city" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
    
@endsection