@extends('layouts.front_layout.front_layout')
@section('content')

<!-- ./Main slider starts-->

<section class="banner_slider subpage-slider">
 <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
 <div class="breadCrumbNav">
   <div class="container breadcrumb-container">
     <h1 class="breadCrumb_title"> Order Summary Details</h1>
     <div class="breadcumb-inner">
       <ul>
         <li><a href="{{route('home')}}" class="breadCrumb_link">HOME</a></li>
         <li><span>Order</span></li>
       </ul>
     </div>
   </div>
 </div>
</section>
<section class="vertical-tab-section">
    <div class="container tab-container">
      <heading class="section_tittle text-center py-3"> 
        <!--  <p>Our Services</p>-->
        <h1 class="section_title">Checkout Summary</h1>
      </heading>
      <table id="cartContentsDisplay" width="100%" cellspacing="0" cellpadding="0" border="0">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Imae</th>
            <th>Place</th>
            <th>Checkin</th>
            <th>Number of Customer</th>
            <th> Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            <?php  $i=1;
            $subTotal = 0;
            ?>
            @foreach ($carts as $item)
                <tr>
                    <td>{{$i}}</td>
                    <?php $i++ ?>
                    <td><a href="#"><img src="{{asset($item->image)}}" width="200" height="150"></a></td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->checkin}}</td>
                    <td><span class="">{{$item->number_of_customer}} </td>
                    <td>{{$item->price}} </td>
                    <td>{{$item->price}} </td>
                </tr>
                <?php $subTotal +=$item->price ;?>
            @endforeach
      </table>
      <div class="price-total">
        <table id="shopcart-total" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
          <tbody>
            <tr>
                <td class="price-of">Cart Sub Total:</td>
                <td>{{$subTotal}}</td>
              </tr>
              <tr>
                <td class="price-of"> Discount</td>
                <td>(-) 00.00</td>
              </tr>
              
              <tr class="grand-total">
                <td class="price-of">Grand Total:</td>
                <td>{{$subTotal}}</td>
              </tr>
          </tbody>
        </table>
        
        <!--<div class="shopping-btn">
  <a class="btn btn-default shop" title="Continue shopping" href="#" style="">Continue shopping</a>
  </div>--> 
        
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4 class="panel-title">Payment Methods</h4>
            </div>
            <div id="checkout-collapse4">
              <div class="panel-body">
                <form class="paymethod" role="form" method="post" action="{{route('place.order')}}">
                    @csrf
                    <input type="hidden" name="total" value="{{$subTotal}}">
                  <div class="form-group stylish-input">
                    <input type="radio" checked  name="paymentMethod" value="Cash In Hand" data-label="Method 1"  class="a"  id="a"  onclick="return button1();" />
                    <a class=" " href="#"></a>
                    <label for="paymentMethod1">Cash In Hand &nbsp; &nbsp;<img src="images/paypal.png"></label>
                  </div>
                  <div class="form-group stylish-input">
                    <input type="radio"   name="paymentMethod" value="Bank Trasnfer" data-label="Method 2" class="b"  onclick="return button2();" />
                    <a class=" " href="#"></a>
                    <label for="paymentMethod">Direct Bank Transfer &nbsp; &nbsp;<img src="images/bank.png"></label>
                  </div>
                  {{-- <div id="button">
                    <div id="button1"></div>
                    <div id="button2">
                      <div class="row direct-bank-transfer">
                        <div class="col-12 col-sm-12 col-md-6">
                          <div class="form-group stylish-input">
                            <label for="inputFirstname" class="col-sm-4 col-lg-4 control-label required">First Name</label>
                            <div class="col-sm-8 col-lg-8">
                              <input type="text" class="form-control" id="inputFirstname" />
                            </div>
                          </div>
                          <div class="form-group stylish-input">
                            <label for="inputLastname" class="col-sm-4 col-lg-4 control-label required">Last Name</label>
                            <div class="col-sm-8 col-lg-8">
                              <input type="text" class="form-control" id="inputLastname" />
                            </div>
                          </div>
                          <div class="form-group stylish-input">
                            <label for="inputEmail2" class="col-sm-4 col-lg-4 control-label required">E-Mail</label>
                            <div class="col-sm-8 col-lg-8">
                              <input type="email" class="form-control" id="inputEmail2" />
                            </div>
                          </div>
                          <div class="form-group stylish-input">
                            <label for="inputFax" class="col-sm-4 col-lg-4 control-label">Credit Card Number</label>
                            <div class="col-sm-8 col-lg-8">
                              <input type="text" class="form-control" id="inputFax" />
                            </div>
                          </div>
                          <div class="form-group stylish-input">
                            <label for="inputCompany" class="col-sm-4 col-lg-4 control-label">Expiration Date</label>
                            <div class="col-sm-8 col-lg-8">
                              <div class="row">
                                <div class="col-sm-6">
                                  <select name="birthmonth" class="form-control">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <select name="birthyear" class="form-control" >
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group stylish-input">
                            <label for="inputFax" class="col-sm-4 col-lg-4 control-label">Card Security Code</label>
                            <div class="col-sm-8 col-lg-8">
                              <input type="number" class="form-control" id="security-code" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="space20 clearfix"></div>
                    </div>
                  </div> --}}
                  <div class="space20 clearfix"></div>
                  <div class="shopping-btn">
                    <input type="submit" value="Place Order">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection