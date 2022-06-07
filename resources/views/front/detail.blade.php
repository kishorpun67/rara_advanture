 @extends('layouts.front_layout.front_layout')
 @section('content')
 <!-- ./Main slider starts-->

<section class="banner_slider subpage-slider">
    <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
    <div class="breadCrumbNav">
      <div class="container breadcrumb-container">
        <h1 class="breadCrumb_title"> Water Adventure</h1>
        <div class="breadcumb-inner">
          <ul>
            <li><a href="index.html" class="breadCrumb_link">Home</a></li>
            <li><span>Menu Detail</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  
  <!-- ./Main slider ends-->
  
  <div class="product-slider">
    <div class="container inner_content">
      <div class="row">
        <div class="col col-sm-8">
          <div id="carousel" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" 
           data-interval="false">
            <div class="carousel-inner" role="listbox">
              <div class="item active"> <img src="{{ asset($posts->image) }}" class="mainImage"> </div>
            </div>
                        <!-- Left Control --> 
      {{-- <a class="left carousel-control" href="#carousel" role="button" data-slide="prev"> <span class="fa fa-angle-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>  --}}
      
      <!-- Right Control --> 
      {{-- <a class="right carousel-control" href="#carousel" role="button" data-slide="next"> <span class="fa fa-angle-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>  --}}
          </div>      
          <div class="clearfix clear">
            @if (!$posts->images->isEmpty())

            <div id="thumbcarousel" class="carousel slide" data-interval="false">   <!-- /thumbcarousel start--> 
            

              <div class="carousel-inner"> <!-- /carousel-inner start--> 
                <?php 
                $i=1;
                  ?>
                  @foreach ($posts->images->chunk(3) as $chunk)
                  <div class="item @if($i==1) active @endif">
                    @foreach ($chunk as $item)
                        <div data-target="#carousel" data-slide-to="{{$item->id}}" class="thumb"> <img class="changeImage" src="{{ asset($item->image) }}"></div>
                    @endforeach
                  </div>
                  <?php  $i++ ?>

                  @endforeach
              </div>
              <!-- /carousel-innerend --> 
              
               <!-- Left Control --> 
              <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"> </i> </a> 
              
                 <!-- Right Control --> 
              <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a>
               </div>
            <!-- /thumbcarousel end-->
            @endif
 
            
          </div>
          
          
          <summary class="tour-summary">
   
          <p>{{ $posts->details }}</p> 
    </summary><h2>@if (auth()->check()) Reviews @else Login for Reviews
               @endif</h2>    
       @if (auth()->check())
           <?php 
           $comment = "block";
           $login = "none"
           ?>

       @else
       <?php 
       $comment = "none";
       $login = "block"
       ?>
       @endif
       <div class="tour-review rating-static" style="display: {{$comment}}"> 
            
        <span class="reviews-stars" >
           <i class="fa fa-star"  onclick="rating(this.getAttribute('attr'))"   attr=1 id="star-1"  aria-hidden="true"></i> 
           <i class="fa fa-star-o" onclick="rating(this.getAttribute('attr'))" attr=2 id="star-2" aria-hidden="true"></i> 
           <i class="fa fa-star-o" onclick="rating(this.getAttribute('attr'))"  attr=3 id="star-3" aria-hidden="true"></i> 
           <i class="fa fa-star-o" onclick="rating(this.getAttribute('attr'))"  attr=4 id="star-4" aria-hidden="true"></i> 
           <i class="fa fa-star-o" onclick="rating(this.getAttribute('attr'))"  attr=5 id="star-5"  aria-hidden="true"></i> 
          </span> 
         </div>
      
      <div class="review-form">

        <form action="{{ route('comment')}}" method="post" style="display:{{$comment}}">
          @csrf
          <input type="hidden" name="post_id" value="{{$posts->id}}">
          <input type="hidden" name="star" id="star" value="1">

          <div class="form-group">
            <textarea id="review" class="form-control" name="message" placeholder="Write a review..."></textarea> 
          </div>
            
          <div class="form-group">
              <button class="btn submit-btn" type="submit">Submit</button>
            </div>
        </form>
           <h4><a href="{{route('login')}}" style="display: {{$login}}">Login</a></h4>
       <div class="body_comment">
              <ul id="list_comment" class="col-xs-12">
                @foreach($comments as $data)
                <!-- Start List Comment 1 -->
                <li class="box_result">
                  <div class="avatar_comment"> <img src="{{ asset('frontend/images/avatar.jpg') }}" alt="avatar"/>  </div>
                  <div class="result_comment">
                    <h4>{{$data->name}}</h4>
                    <div class="tour-review rating-static">
                       <span class="reviews-stars">
                        <?php
                        $x = $data->star;
                        while($x > 0) {
                        echo '<i class="fa fa-star" aria-hidden="true"></i> ';
                        $x--;
                        }
                        $y = 5-$data->star;
                      // echo $;
                      while($y > 0) {
                      echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                      $y--;
                      }
                    ?>
                      </span> 
                    </div>
                    <p>{{ $data->message }}</p>
                    <div class="tools_comment">  
                      <span class="comment-time">{{$data->created_at->diffForHumans()}}</span> </div>
                    </div>
                </li> 
              @endforeach
              </ul>
            </div>
        </div>   
      </div>
        <div class="col col-sm-4">
          <h2 class="">{{ $posts->title }}</h2>
          <div class="tour-review rating-static"> 
            <span class="reviews-stars"> 
             
              <?php
                  $x = $avag_star_rating;
                  
                  while($x > 0) {
                  echo '<i class="fa fa-star" aria-hidden="true"></i>';
                  $x--;
                  }
                  $y = 5-$avag_star_rating;
                  // echo $;
                  while($y > 0) {
                  echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                  $y--;
                  }
              ?>
            </span> 
            <span class="reviews-count">({{$avag_rating}})</span> </div>
            <div class="tour-price mt-3"><span id="post_price">{{ $posts->price }}</span>   </div>
              <div class="price-neg mt-3">Price varies by group size</span>
            <div class="price-neg mt-3"> <b><i class="fas fa-clock"></i> {{ $posts->price_type }} days (approx)</b>&nbsp;<span></span>

                <div class="mt-3">
                  <form action="{{route('add.cart')}}" method="post">
                    @csrf
                    <label for="checkin">Select Date and Travelers</label>
                    <input type="date" name="checkin" class="form-control" id="" min="{{$posts->start_date}}" max="{{$posts->end_date}}" value=""> 
                    <label for="number_of_customer">No of Customer</label>
                    <input name="number_of_customer" class="form-control" type="number"  
                    id="number_of_customer" placeholder="No of Customer" min="1"  value="1">
                    <input type="hidden" name="" id="get_post_price" value="{{$posts->price}}">
                    <input type="hidden" name="post_id" id="" value="{{ $posts->id }}">
                    <input type="hidden" name="title" id="" value="{{ $posts->title }}">
                    <input type="hidden" name="price" id="total_price" value="{{ $posts->price }}">
                    <input type="hidden" name="image" id="" value="{{ $posts->image }}">
                    <br>
                    <button class="btn view_btn book-btn"type="submit">Book now</button>
                  </form>
                </div>
              <div class="mt-4">
              <ul class="social_icons">
                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#" title=""><i class="fab fa-twitter"></i> </a></li>
                <li><a href="#" title=""><i class="fab fa-instagram"></i> </a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--// footer section starts-->
  
  
 @endsection