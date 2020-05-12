$(document).ready(function(){

  // Slider
	$('.main-carousel').flickity({
        autoPlay: 5000,
        cellAlign: 'right',
		wrapAround: true,
    });

  // Navbar
  $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
		event.preventDefault(); 
		event.stopPropagation(); 
		$(this).parent().siblings().removeClass('open');
		$(this).parent().toggleClass('open');
  });
  $(window).on('scroll',function(){
		if(window.pageYOffset > 100) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }
  });
  if(window.pageYOffset > 100) {
    $('header').addClass('sticky');
  } else {
    $('header').removeClass('sticky');
  }
  $('header .modal .nav-tabs> a').on('click',function(){
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
  })
  $('.forget-password').on('click',function(){
    $('#nav-login .login-form').fadeOut(500);
    $('#nav-login .signup-social').fadeOut(500);
    $('#nav-login .password-show').delay(500).fadeIn(500);
  });

  $('header .modal button.close').on('click',function(){
    $('#nav-login .login-form').fadeIn(500);
    $('#nav-login .signup-social').fadeIn(500);
    $('#nav-login .password-show').fadeOut(500);
  });

  //search 
  $('.search-block .input.type .chices-block ul li .title').on('click',function(){
    var search_option = $(this).children('.word').text();
    $('.search-block .input.type p.choice').fadeOut(200, function(){
      $(this).text(search_option);
      $('.search-inputs form .type').val(search_option);
      $(this).fadeIn(200);
    })
  });
  $('.search-block .input.city .chices-block ul li .title').on('click',function(){
    var city_option = $(this).children('.word').text();
    $('.search-block .input.city p.choice').fadeOut(200, function(){
      $(this).text(city_option);
      $('.search-inputs form .city').val(city_option);
      $(this).fadeIn(200);
    })
  });

  //Star rating
  $('.star-rating input[type=radio]:checked:disabled').each(function(){
    $(this).prevAll('label').addClass('none');
  });
  
});