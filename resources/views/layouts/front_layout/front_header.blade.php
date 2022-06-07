<?php 
use App\Admin\Admin;
use App\Admin\Category;
use App\Contact;
$admin= Admin::where('id', Session::get('admin_id'))->first();
$categoy = Category::where('show_header',1)->where('status',1)->get();
$contact = Contact::first();

?>
<header class="top_header">
  <!-- ./top-bar-->
  <div class="topbar">
    <div class="container">
      <address class="top-contact-address topbar-items">
      <ul>
        <li>
          <figure class="icon"> <i class="fas fa-phone-alt"></i> </figure>
          <div class="details"> <span>{{$contact->hot_line}}</span> </div>
        </li>
        <li>
          <figure class="icon"> <i class="far fa-clock"></i></figure>
          <div class="details"> <span>6AM To 7PM</span> </div>
        </li>
      </ul>
      </address>
      <div class="top_social_icons topbar-items">
        <ul>
          <li><a target="_blank" href="{{$contact->facebook}}" title=""><i class="fab fa-facebook-f"></i></a></li>
          <li><a target="_blank" href="{{$contact->twiter}}" title=""><i class="fab fa-twitter"></i> </a></li>
          <li><a target="_blank" href="{{$contact->instagram}}" title=""><i class="fab fa-instagram"></i> </a></li>
        </ul>
        <div class="form_search">
          <form role="form" action="{{route('search.post.area')}}" method="post">
            @csrf
            <div class="searchbox">
              <input type="search" placeholder="Search......" name="search" class="searchbox-input" id="show_post" autocomplete="off"   required>
              <div id="post"></div>

              <button type="submit" class="searchbox-submit" value="GO">
              <span class="searchbox-icon"><i class="fa fa-search"></i></span>
              </button>
             </div>


          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- ./top-bar-->
  <div id="pav-mainnav"><!-- ./pav-mainnav-->
    <div class="navigation-bar"><!-- ./navigation-bar-->
      <div class="container">
        <div class="row nav-row">
          <div class="col col-sm-3 col-xs-12">
            <figure class="logo_holder"><a href="{{route('home')}}"> <img src="{{asset('frontend/images/weblogo.png')}}" alt="This is logo image"> </a></figure>
          </div>
          <div class="col col-sm-9 col-xs-12 ">
            <div class="nav-wrapper">
              <div id="mainContent">
                <div id="myCanvasNav" class="overlay3" onclick="closeOffcanvas()" style="width: 0%; opacity: 0;"></div>
                <div id="myOffcanvas" class="offcanvas" >
                  <div class="navbar navbar-default" role="navigation"> <!--//Navbar -->
                    <div class="side_nav"><!--nav-collapse-->
                      <ul class="nav navbar-nav">
                        @foreach ($categoy as $item)
                        <li class=""><a href="{{route('post.list', $item->url)}}"> {{$item->category}}</a></li>
                        @endforeach
                        @if (auth()->check())
                          <li class=""><a href="{{route('account')}}"><i class="fa fa-user" aria-hidden="true"></i> Account</a></li>
                        @else                        
                          <li class=""><a href="{{route('login')}}"> Login</a></li>
                        @endif
                        <li class=""><a href="{{route('cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>

                      </ul>
                    </div>
                    <!--/.nav-collapse --> 
                  </div>
                  <!--//Navbar --> 
                </div>
                <!--offcanvas-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"  onclick="openNav3(); openOffcanvas()"> <span class="toggle-bar"></span> </button>
              </div>
              
              <!--//toggle sidebar menu starts--> 
              
              <!--//toggle sidebar menu ends--> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ./navigation-bar--> 
  </div>
  <!-- ./pav-mainnav--> 
</header>
