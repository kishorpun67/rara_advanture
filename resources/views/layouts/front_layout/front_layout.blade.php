
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@if(!empty($meta_description))
<meta name="description" content="{{$meta_description}}">
@endif
@if(!empty($meta_keywords))
<meta name="keywords" content="{{$meta_keywords}}">
@endif<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<title> @if(!empty($meta_title)){{$meta_title}} @else Taravel | Home @endif</title>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fontawesome-free-5.15.2-web/css/fontawesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fontawesome-free-5.15.2-web/css/solid.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fontawesome-free-5.15.2-web/css/regular.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fontawesome-free-5.15.2-web/css/brands.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome-4.7.0.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fonts.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap-touch-slider.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/lightbox/css/lightbox.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.carouselv2.3.4.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/reset.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/layout.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/side_nav.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/navbar.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}" />
<!-- HTML5 shim and Respond.js')}} for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
<![endif]-->
</head>
<body>
  @yield('style')
  @include('layouts.front_layout.front_header')
  @yield('content')
  @include('layouts.front_layout.front_footer')

<section class="back_top"><!--//back to top scroll-->
  <div class="container">
    <div id="back-top" style="display: block;"> <a href="#top" title="Go to top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  </div>
</section>
<!--//back to top scroll--> 

<script type="text/javascript" src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/owl.carouselv2.3.4.js')}}"></script> 
<script type="text/javascript">
 
$('.popular-tour .owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
 
	
   500: {
	items: 2
  },
	
    768: {
      items: 3
    },
	
   992: {
      items: 3
    },
  
  }
})



$('.testimonial_content .owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  navText: [
    "<i class='fa fa-caret-left'></i>",
    "<i class='fa fa-caret-right'></i>"
  ],
  autoplay: true,
  autoplayHoverPause: true,
  responsive: {
    0: {
      items: 1
    },
 
 
 	480: {
	items: 1
  },
	
    600: {
      items: 1
    },
	
    1000: {
      items:1
    }
  }
})

</script> 
<script type="text/javascript" src="{{asset('frontend/js/fixed-nav.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/Push_up_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/annimatable_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/side_nav.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/search_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/touch_jquery.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/js/bootstrap-touch-slider.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/front_script.js')}}"></script> 

<script type="text/javascript">
  $('#carousel').carousel({
    interval: 5000,
    cycle: true,
    pause: "null"
  }); 
  </script> 
  <script type="text/javascript">
      $('#carousel').bsTouchSlider();
   </script> 
</body>
</html>

