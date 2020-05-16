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

  
 /* -- increase and dicease quantity  -- */
 $('.decrease-btn').on('click',function(){
  if ($(this).next().val() > 0) {
    $(this).next().val(+$(this).next().val() - 1);
  }
})
$('.increase-btn').on('click',function(){
  $(this).prev().val(+$(this).prev().val() + 1);
})
/* -- ./increase and dicease quantity  -- */

/* -- Calcoulat price -- */
var total_amount = 0;
$('.cart-product .total').siblings('.value-button').on('click', function(){
  total_amount = 0;
  var count = $(this).siblings('input').val();
  var price = parseInt($(this).siblings('.stander').attr('value'));
  $(this).siblings('.total').text('ADE ' + price * count );
  $('.cart-product .total').each(function(){
    total_amount += parseInt($(this).text().slice(4));
  });
  $('.total-shopping .total-shopping-price').text('ADE ' + total_amount);
});
$('.cart-btn').on('click', function(){
  $('.cart-block').toggleClass('active');
  $('.alloverlay').fadeToggle(500);
});
$('.alloverlay').on('click',function(){
  $('.cart-block').toggleClass('active');
  $('.alloverlay').fadeToggle(500);
});

$('.close-cart').on('click',function(){
  $('.cart-block').toggleClass('active');
  $('.alloverlay').fadeToggle(500);
});
$('.receipt .value-button').on('click', function(){
  total_amount = 0;
  var count = $(this).siblings('input').val();
  var price = parseInt($(this).siblings('.item-price').attr('value'));
  $(this).parent().siblings('.pr-price').text('ADE ' + price * count );
  $('.pr-price').each(function(){
    total_amount += parseInt($(this).text().slice(4));
  });
  $('.sub-total .total-price').text('ADE ' + total_amount);
});
/* -- ./Calcoulat price -- */

 /* -- Outside nav links -- */
 $('.payment a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var target = this.href.split('#');
  $('.nav a').filter('[href="#'+target[1]+'"]').tab('show');        
})
/* -- ./Outside nav links --*/
  
});