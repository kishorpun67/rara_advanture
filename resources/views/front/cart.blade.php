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
<section class="vertical-tab-section">
    <div class="container tab-container">
    
    
    <heading class="section_tittle text-center py-3"> 
        <!--  <p>Our Services</p>-->
        <h1 class="section_title">Checkout</h1>
        
      </heading>
      <table id="cartContentsDisplay" width="100%" cellspacing="0" cellpadding="0" border="0">
        <thead>
          <tr>
            <th>S.N</th>
            <th>Imae</th>
            <th>Title</th>
            <th>Checkin</th>
            <th>Checkout</th>
            <th> Price</th>
            <th>Total</th>
            <th>Remove</th>
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
                    <td><span class="old-price">{{$item->checkout}} </td>
                    <td>{{$item->price}} </td>
                    <td>{{$item->price}} </td>

                    <td><a href="#" title="Delete"><i class="fa fa-trash-o"></i></a></td>
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
        
        <div class="proceed-btn"> <a class="btn btn-default" title="Proceed to checkout" href="{{route('checkout')}}" style="">Proceed to checkout</a> </div>
      </div>
    </div>
  </section>
@endsection