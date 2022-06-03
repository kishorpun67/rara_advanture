<?php 
use App\Contact;

$contact = Contact::first();

?>
<!--// footer section starts-->

<footer class="footer pt-6">
  <div class="footer_contents">
    <div class="container">
      <div class="row">
        <div class="col col-sm-3 col-xs-6">
          <h3 class="footer_title">About Company</h3>
          <figure class="logo_holder footer-logo"><a href="index.html"> <img src="{{asset('frontend/images/weblogo.png')}}" alt="This is footer logo"> </a></figure>
          <ul>
            <li><a href="team.html">Our Team</a></li>
            <li><a href="reviews.html">Reviews</a></li>
            <li><a href="blog.html">Blog </a></li>
          </ul>
          <div class="footer-social-icons">
            <h4 class="footer_title">Follow Us</h4>
            <ul>
              <li><a href="{{$contact->facebook}}"><i class="fab fa-facebook-f"></i> </a></li>
              <li><a href="{{$contact->twiter}}"><i class="fab fa-twitter"></i> </a></li>
              <li><a href="{{$contact->instagram}}"><i class="fab fa-instagram"></i> </a></li>
            </ul>
          </div>
        </div>
        <div class="col col-sm-3 col-xs-6">
          <h3 class="footer_title">Activities</h3>
          <ul>
            <li><a href="trekking.html">Trekking</a></li>
            <li><a href="peak_climbing.html">Peak Climbing</a></li>
            <li><a href="adventure.html">Adventure</a></li>
            <li><a href="Luxury_Treks.html">Luxury Treks</a></li>
            <li><a href="cultural_tours.html">Cultural Tours</a></li>
            <li><a href="yoga_trek.html">Yoga Trek</a></li>
            <li><a href="trip_extensions.html">Trip Extensions</a></li>
            <li><a href="bike_tour.html">Motorbike Tours</a></li>
            <li><a href="day_tour.html">Day Tours</a></li>
          </ul>
        </div>
        <div class="col col-sm-3 col-xs-6">
          <h3 class="footer_title">Useful Links</h3>
          <ul>
            <li><a href="trip_finder.html">Trip Finder</a></li>
            <li><a href="tailor_made.html">Tailor Made</a></li>
            <li><a href="faqs.html">FAQs</a></li>
            <li><a href="booking_terms.html">Booking Terms</a></li>
            <li><a href="{{route('login')}}">Registration Form</a></li>
          </ul>
        </div>
        <div class="col col-sm-3 col-xs-6">
          <h3 class="footer_title">Contact Us</h3>
          <div class="footer_address">
            <address>
            <figure class="icon"><i class="fa fa-home" aria-hidden="true"></i></figure>
            <div class="details"> 
              <!--        <span>Little Buddha College of Health Sciences </span>--> 
              {{-- <span>New Baneshwor</span><br> --}}
              <span>{{$contact->address}}</span> </div>
            </address>
            <address>
            <figure class="icon"> <i class="fa fa-phone" aria-hidden="true"></i> </figure>
            <div class="details"> <a class="call" href="tel:01 - 4784458">{{$contact->hot_line}}</a> ,<a class="quick-call" href="tel:01 - 4784459"> {{$contact->mobile}}</a> </div>
            </address>
            <address>
            <figure class="icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </figure>
            <div class="details"> <a href="{{$contact->gmail}}" class="linkto">{{$contact->gmail}}</a> </div>
            </address>
          </div>
          <div class="footer-social-icons">
            <h4 class="footer_title">We Accept Payment:</h4>
            <ul>
              <li><a href="#"><img src="{{asset('frontend/images/payment-7summit.png')}}" alt="" title=""> </a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer_logo_bar">
    <div class="container">
      <div class="column_lft items">
        <h4 class="logo_title">Associated With:</h4>
        <ul class="official_logo items">
          <li><a href="#"><img src="{{asset('frontend/images/official_logo1.png')}}"></a></li>
          <li><a href="#"><img src="{{asset('frontend/images/official_logo2.png')}}"></a></li>
          <li><a href="#"><img src="{{asset('frontend/images/official_logo3.png')}}"></a></li>
          <li><a href="#"><img src="{{asset('frontend/images/official_logo4.png')}}"></a></li>
          <li><a href="#"><img src="{{asset('frontend/images/official_logo5.png')}}"></a></li>
        </ul>
      </div>
      <div class="column_rht items">
        <h4 class="logo_title">Recommended:</h4>
        <ul class="official_logo recommended-logo">
          <li><a href="#"><img src="{{asset('frontend/images/official_logo7.png')}}"></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="copyright">
    <div class="container">
      <p class="lft">© <script type="text/javascript" language="javascript">var date = new Date(); document.write(date.getFullYear());</script> All Rights Reserved.</p>
      <p class="rht"> Powered by: <a href="https://rarasoft.business.site/" target="_blank" class="company_link" collator_asort="">&nbsp;Rara Soft Pvt. Ltd</a> </p>
    </div>
  </div>
</footer>
