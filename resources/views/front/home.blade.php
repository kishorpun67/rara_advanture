

 @extends('layouts.front_layout.front_layout')
 @section('content')
 <?php 
 use App\Admin\Item;
 use App\Comment;

 
 ?>
 
<section class="banner_slider">
  <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="false"> 
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#bootstrap-touch-slider" data-slide-to="0" class=""></li>
      <li data-target="#bootstrap-touch-slider" data-slide-to="1" class=""></li>
      <li data-target="#bootstrap-touch-slider" data-slide-to="2" class=""></li>
    </ol>
    
    <!-- Wrapper For Slides -->
    <div class="carousel-inner" role="listbox"> 
      
      <!-- Third Slide -->
      <?php 
       $id =0;
      ?>
      @foreach ($banners as $item)
       @if( $id == 0)
      <?php $active = "active"; ?>
        @else
        <?php $active = ""; ?>
        @endif
      <div class="item {{$active}}"> 
        
        <!-- Slide Background --> 
        <img src="{{asset($item->image)}}" alt="" class="slide-image">
        <div class="bs-slider-overlay"></div>
        <!-- Slide Text Layer -->
        <div class="slide-text slide_style_center container">
          <h1 data-animation="animated fadeInLeft">{{$item->title_first}}</h1>
          <h2 data-animation="animated zoomInRight">{{$item->title_second}}</h2>
          <p data-animation="animated lightSpeedIn" class="">{{$item->description}}</p>
          <a href="#" class="btn slide_btn" data-animation="animated zoomInUp">View Tours</a> </div>
      </div>
      <?php 
        $id = $id+1;
      ?>
      @endforeach

      
      
    </div>
    <!-- End of Wrapper For Slides --> 
    
    <!-- Left Control --> 
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev"> <span class="fa fa-angle-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> 
    
    <!-- Right Control --> 
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next"> <span class="fa fa-angle-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
</section>

<!--===========	Choose section starts ======// -->

<section class="choose_section section_wrapper">
  <div class="container">
    <h2 class="section_title border left">Why Choose US</h2>
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="row choose-bar ">
          @foreach ($choose as $choose )
            <div class="col col-md-4 col-sm-6 col-xs-6">
              <figure class="icon-user items"> <span><i class="{{$choose->icon}}"></i></span> </figure>
              <figcaption class="icon-caption">
                <h4>{{$choose->title}}</h4>
                <p>{{$choose->description}}</p>
              </figcaption>
            </div>
          @endforeach
     
          
        </div>
      </div>
      {{-- <div class="col-md-3">
        <aside class="sidebar_search_form">
          <div class="sidebar_search_title">
            <h2> Search Tours</h2>
            <h4>Find your Dream Tour Today</h4>
          </div>
          <form role="form">
            <div class="form-group" id="search-tour">
              <input type="search" class="form-control" placeholder="Search Tours...." >
              <button type="submit" class="btn btn-search-tour"> </button>
            </div>
            <div class="form-group select_dropdown" id="destination">
              <select class="form-control" name="destination">
                <option value="" selected>Destination</option>
                <option value="Pokhara">Pokhara</option>
                <option value="Manang">Manang</option>
                <option value="Chitwan">Chitwan</option>
              </select>
            </div>
            <div class="form-group select_dropdown" id="tour-type">
              <select class="form-control" name="tour-type">
                <option value="" selected>Tour Type</option>
                <option value="walking">Walking</option>
                <option value="cycling">Cycling</option>
                <option value="Hiking">Hiking</option>
              </select>
            </div>
            <div class="form-group" id="date">
              <input type="date" class="form-control">
            </div>
            <div class="form-group">
              <div>
                <input class=" btn btn-primary view_btn tour-btn" type="submit" value="Find Tours">
              </div>
            </div>
          </form>
        </aside>
      </div> --}}
    </div>
  </div>
</section>

<!--===========	Popular Tour starts ====== // -->

<section class="popular-tour">
  <div class="container">
    <div class="heading">
      <h3 class="center"><i>Take a look at our</i></h3>
      <h2 class="section_title border">MOST POPULAR TOURS</h2>
    </div>
    <div class="row">
      <div class="col-sm-offset-1 col-sm-10">
        <div class="carousel-wrap">
          <div class="owl-carousel owl-theme">
            @foreach ($mostPopularTours as $popular)
              <div class="item"> <a href="{{ route('post.detail', $popular->url) }}">
                <figure class="expedition_img"> <img src="{{asset($popular->image)}}">
                  <div class="box_caption">
                    <h3>{{$popular->title}}</h3>
                  </div>
                  <?php 
                    $rating_sum = Comment::where(['post_id'=>$popular->id])->sum('star');
                    $rating_count = Comment::where(['post_id'=>$popular->id])->count();
                    if ($rating_count >0) {
                        $avag_rating = round($rating_sum/$rating_count, 2);
                        $avag_star_rating = round($rating_sum/$rating_count);        
                    } else{
                        $avag_rating = 0;
                        $avag_star_rating = 0; 
                    }
                  ?>
                  <div class="tour-review"> 
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
                    </span> <span class="reviews-count">({{$avag_rating}})</span> 
                  </div>
                  <div class="price_box"> <span>From {{$popular->price}}</span> </div>
                </figure>
                </a>
                <figcaption class="expedition_caption">
                  <div class="expedition_wrapper">
                    <h4>{{$popular->title}}</h4>
                    <p>{{$popular->details}}</p>
                  </div>
                </figcaption>
              </div>
            @endforeach
           
           
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--===========	Deals and Discount section starts ====== // -->

<section class="deal-section pt-5">
  <div class="container">
    <div class="heading">
      <h2 class="section_title border left"> Deals & Dicount </h2>
      <p>Lorem ipsum dolor sit amet consectetur tsed eliectetur adipiscing elitsed </p>
    </div>
    <div class="row mt-5">
      @forelse ($mostPopularTours as $item)
      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset($item->image)}}">
          <div class="box_caption">
            <h3>{{$popular->title}}</h3>
          </div>
          <?php 
            $rating_sum = Comment::where(['post_id'=>$item->id])->sum('star');
            $rating_count = Comment::where(['post_id'=>$item->id])->count();
            if ($rating_count >0) {
                $avag_rating = round($rating_sum/$rating_count, 2);
                $avag_star_rating = round($rating_sum/$rating_count);        
            } else{
                $avag_rating = 0;
                $avag_star_rating = 0; 
            }
          ?>
          <div class="tour-review"> 
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
            </span> <span class="reviews-count">({{$avag_rating}})</span> 
          </div>
          <div class="price_box"> <span>From {{$popular->price}}</span> </div>
          
          <div class="price_box circle_box"> <span> {{$item->price}}</span> </div>
        </figure>
        </a>
        <figcaption class="expedition_caption">
          <div class="expedition_wrapper">
            <h4>{{$item->title}}</h4>
            <p>{{$item->details}}</p>
          </div>
        </figcaption>
      </div>
      @empty
          
      @endforelse
  
 
      
    </div>
  </div>
</section>

<!--===========	Destination section starts ====== // -->

<section class="destination-section pt-5">
  <div class="container">
    <div class="heading">
      <h3 class="center"><i>Take a look at our</i></h3>
      <h2 class="section_title border">Destinations</h2>
    </div>
    <div class="row mt-5">
      @forelse ($mostPopularTours as $item)

      <div class="col col-md-3 col-sm-4 col-xs-6 mb-5"> <a href="#">
        <figure class="expedition_img"> <img src="{{asset($item->image)}}">
          <figcaption class="expedition_caption">
            <div class="box_caption">
              <h3>{{$item->title}}</h3>
            </div>
          </figcaption>
        </figure>
        </a>
      </div>
      @empty

      @endforelse
    </div>
  </div>
</section>

<!--===========	Destination section ends ====== // --> 

<!--===========//Tour section starts ===========// -->

<section class="adventure-tour-content">
  <div class="container">
    <div class="adventure-tour-wrapper">
      <div class="heading">
        <h3 class="center white_txt"><i>Find a tour by</i></h3>
        <h2 class="section_title border white_txt">Tour Type</h2>
      </div>
      <ul class="d-flex adventure-flex-wrap">
        @foreach ($tourType as $item)
        <li class="items"> <a href="#">
          <div class="thumb-circle-item">
            <div class="thumb-circle-inner"> <i class="{{$item->icon}}"></i> <span>{{$item->type}}</span> </div>
          </div>
          <!--<div class="summit-titles"> <span>Asia</span>
              <h4>Denali</h4>
            </div>--> 
          </a> 
        </li>
        @endforeach
       
       
      </ul>
    </div>
  </div>
</section>

<!--===========//Blog Section starts ===========// -->

<section class="blog_content section_wrapper">
  <div class="container">
    <div class="row">
      <div class="col col-sm-6 col-xs-6">
        <div class="heading">
          <h2 class="section_title border">LATEST POST</h2>
        </div>
        <div class="post_wrapper pt-3">
          <figure class="post_thumb"> <img src="{{asset('frontend/images/blog1.png')}}"> </figure>
          <figcaption class="post_caption">
            <h4 class="blog_title">Thursday, 06 July 2017</h4>
            <span class="date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Thursday, 06 July 2017</span>
            <p class="blog_detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent neque sem, elementum vel elit ut, scelerisque scipit ac nisl in </p>
            <a href="#" class="btn blog_btn">Read More</a> </figcaption>
        </div>
      </div>
      <div class="col col-sm-6 col-xs-6">
        <div class="heading">
          <h2 class="section_title border">TOUR REVIEWS</h2>
        </div>
        <aside class="review_side blog_side pt-3">
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_1.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_2.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
          <article>
            <figure class="blog_side_img img-circle"> <img src="{{asset('frontend/images/testimonial_3.jpg')}}" alt="" title=""> </figure>
            <figcaption class="blog_side_caption">
              <author class="review-title">Rockies </author>
              <p class="review-detail">Nemo enim ipsam voluptatem quia </p>
              <span class="review-date">24 Feb 2019</span> <a href="#">Continue Reading</a> </figcaption>
          </article>
        </aside>
      </div>
    </div>
  </div>
</section>


<!--===========//Testimonial section starts ===========// -->

<section class="review_section py-5">
  <div class="container">
    <h2 class="section_title border center white_txt"> OUR HAPPY CUSTOMERS</h2>
    <div class="carousel-wrap testimonial_content">
      <div class="owl-carousel owl-theme space_tp">
        @foreach ($testimonial as $item)
            
        <div class="item "> <a href="#">
          <figure class="img-circle"> <img src="{{asset($item->image)}}" alt=""> </figure>
          </a>
          <figcaption> <span class="author">{{$item->name}}</span> <span class="post">{{$item->porfession}}</span>
            <p>{{$item->description}}</p>
          </figcaption>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


@endsection