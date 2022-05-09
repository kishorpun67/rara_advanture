  
$(".navbar ul li a[href^='#']").on('click', function(e) {

   // prevent default anchor click behavior
   e.preventDefault();

   // store hash
   var hash = this.hash;

   // animate
   $('html, body').animate({
       scrollTop: $(hash).offset().top
     }, 1000, function(){

       // when done, add hash to url
       // (default click behaviour)
       window.location.hash = hash;
     });

});
 
function scrollNav() {
  $('.navbar a').click(function(){  
    //Toggle Class
    $(".active").removeClass("active");      
    $(this).closest('li').addClass("active");
    var theClass = $(this).attr("class");
    $('.'+theClass).parent('li').addClass('active');
    //Animate
    $('html, body').stop().animate({
        scrollTop: $( $(this).attr('href') ).offset().top - 125
    }, 400);
    return false;
  });
  $('.scrollTop a').scrollTop();
}
scrollNav();
 

//jQuery add+remove class on scroll pos starts (sticky tab starts)//

$(document).ready(function() {
	var s = $(".highlight-tab");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top & windowpos <=475) {
			s.removeClass("stick");}
			
			
			
				else if (windowpos >= pos.top & windowpos >=30000) {
			s.removeClass("stick");}
			
			 else {
			s.addClass("stick");	
		}
	});
});



//sticky sidebar starrts


$(document).ready(function() {
	var s = $(".custom-trip");
	var pos = s.position();					   
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if (windowpos >= pos.top & windowpos <=2000) {
			s.removeClass("sticky-sidebar");}
			
			
			
				else if (windowpos >= pos.top & windowpos >=14000) {
			s.removeClass("sticky-sidebar");}
			
			 else {
			s.addClass("sticky-sidebar");	
		}
	});
});
 