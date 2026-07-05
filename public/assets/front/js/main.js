(function ($)
  { "use strict"
  
/* 1. Proloder */
    $(window).on('load', function () {
      $('#preloader-active').delay(450).fadeOut('slow');
      $('body').delay(450).css({
        'overflow': 'visible'
      });
    });


/* 2. slick Nav */
// mobile_menu
    var menu = $('ul#navigation');
    if(menu.length){
      menu.slicknav({
        prependTo: ".mobile_menu",
        closedSymbol: '+',
        openedSymbol:'-'
      });
    };

     // Facts counter
    // $('[data-toggle="counter-up"]').counterUp({
    //     delay: 5,
    //     time: 2000
    // });


     $('.portfolio-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

  
$(document).ready(function(){

    $(".clients-carousel").owlCarousel({
        loop:true,
        margin:20,
        autoplay:true,
        autoplayTimeout:2500,
        autoplayHoverPause:true,
        nav:false,
        dots:false,

        responsive:{
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            }
        }
    });

});

// Roadmap Carousel
$('.roadmap-carousel').owlCarousel({
    loop: true,
    nav: true,
    margin: 30,

    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 1000,
    smartSpeed: 700,
    autoplayHoverPause: true,

    dots: true,

    navText: [
        '<i class="fa fa-long-arrow-left"></i>',
        '<i class="fa fa-long-arrow-right"></i>'
    ],

    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1200: {
            items: 3
        }
    }
});



/* 3. MainSlider-1 */
    // h1-hero-active
    function mainSlider() {
      var BasicSlider = $('.slider-active');
      BasicSlider.on('init', function (e, slick) {
        var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
        doAnimations($firstAnimatingElements);
      });
      BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
        var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
        doAnimations($animatingElements);
      });
      BasicSlider.slick({
        autoplay: false,
        autoplaySpeed: 4000,
        dots: false,
        fade: true,
        arrows: false, 
        prevArrow: '<button type="button" class="slick-prev"><img src="img/hero_thumb/arrow-left.png" alt=""><img class="secondary-img" src="img/hero_thumb/left-white.png" alt=""></button>',
        nextArrow: '<button type="button" class="slick-next"><img src="img/hero_thumb/arrow-right.png" alt=""><img class="secondary-img" src="img/hero_thumb/right-white.png" alt=""></button>',
        responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false
            }
          }
        ]
      });

      function doAnimations(elements) {
        var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        elements.each(function () {
          var $this = $(this);
          var $animationDelay = $this.data('delay');
          var $animationType = 'animated ' + $this.data('animation');
          $this.css({
            'animation-delay': $animationDelay,
            '-webkit-animation-delay': $animationDelay
          });
          $this.addClass($animationType).one(animationEndEvents, function () {
            $this.removeClass($animationType);
          });
        });
      }
    }
    mainSlider();

/* 4. Testimonial Active*/
  var testimonial = $('.h1-testimonial-active');
    if(testimonial.length){
    testimonial.slick({
        dots: false,
        infinite: true,
        speed: 1000,
        autoplay:false,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
              arrow:false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows:false
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows:false,
            }
          }
        ]
      });
    }


/* 5. Gallery Active */
    var client_list = $('.gallery-active');
    if(client_list.length){
      client_list.owlCarousel({
        slidesToShow: 3,
        slidesToScroll: 1,
        loop: true,
        autoplay:true,
        speed: 3000,
        smartSpeed:2000,
        nav: false,
        dots: false,
        margin: 0,

        autoplayHoverPause: true,
        responsive : {
          0 : {
            nav: false,
            items: 2,
          },
          768 : {
            nav: false,
            items: 3,
          }
        }
      });
    }


/* 6. Nice Selectorp  */
  var nice_Select = $('select');
    if(nice_Select.length){
      nice_Select.niceSelect();
    }

/* 7.  Custom Sticky Menu  */
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 245) {
        $(".header-sticky").removeClass("sticky-bar");
      } else {
        $(".header-sticky").addClass("sticky-bar");
      }
    });

    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 245) {
          $(".header-sticky").removeClass("sticky");
      } else {
          $(".header-sticky").addClass("sticky");
      }
    });

    // Industries Carousel
$('.office-carousel').owlCarousel({

    loop: true,
    margin: 30,
    nav: true,
    dots: false,

    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 1000,
    smartSpeed: 700,
    autoplayHoverPause: true,

    navText: [
        '<i class="fa fa-long-arrow-left"></i>',
        '<i class="fa fa-long-arrow-right"></i>'
    ],

    responsive:{
        0:{
            items:1
        },
        576:{
            items:2
        },
        992:{
            items:3
        },
        1200:{
            items:4
        }
    }

});

//==============================
// Blog Carousel
//==============================

$('.blog-carousel').owlCarousel({

    loop: true,

    margin: 30,

    nav: true,

    dots: false,

    autoplay: true,

    autoplayTimeout: 3500,

    autoplaySpeed: 800,

    smartSpeed: 800,

    autoplayHoverPause: true,

    navText: [

        '<i class="fa fa-angle-left"></i>',

        '<i class="fa fa-angle-right"></i>'

    ],

    responsive: {

        0: {
            items: 1
        },

        768: {
            items: 2
        },

        1200: {
            items: 3
        }

    }

});



/* 8. sildeBar scroll */
    $.scrollUp({
      scrollName: 'scrollUp', // Element ID
      topDistance: '300', // Distance from top before showing element (px)
      topSpeed: 300, // Speed back to top (ms)
      animation: 'fade', // Fade, slide, none
      animationInSpeed: 200, // Animation in speed (ms)
      animationOutSpeed: 200, // Animation out speed (ms)
      scrollText: '<i class="ti-arrow-up"></i>', // Text for element
      activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });


/* 9. data-background */
    $("[data-background]").each(function () {
      $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
      });


/* 10. WOW active */
    new WOW().init();



/* 13. counterUp*/
  // $('.counter').counterUp({
  //   delay: 10,
  //   time: 3000
  // });


    
// 11. ---- Mailchimp js --------//  
    function mailChimp() {
      $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();



// 12 Pop Up Img
    var popUp = $('.single_gallery_part, .img-pop-up');
      if(popUp.length){
        popUp.magnificPopup({
          type: 'image',
          gallery:{
            enabled:true
          }
        });
      }


      //=====================================
// Testimonials Carousel
//=====================================

$('.testimonials-carousel').owlCarousel({

    items:1,

    loop:true,

    margin:30,

    nav:false,

    dots:true,

    autoplay:true,

    autoplayTimeout:4000,

    autoplaySpeed:1000,

    smartSpeed:1000,

    autoplayHoverPause:true

});




})(jQuery);

$(document).ready(function () {

    var $grid = $('.grid').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows',
        transitionDuration: '0.6s'
    });

    $('#filter label').on('click', function () {

        $('#filter label').removeClass('btn-main active');
        $(this).addClass('btn-main active');

        var filterValue = $(this).find('input').val();

        if (filterValue === 'all') {
            $grid.isotope({ filter: '*' });
        } else {
            $grid.isotope({
                filter: function () {
                    var groups = $(this).attr('data-groups');
                    return groups.indexOf(filterValue) !== -1;
                }
            });
        }

    });

});



$(document).ready(function(){

    $('.faq-title').click(function(){

        var parent=$(this).parent();

        if(parent.hasClass('active')){

            parent.removeClass('active');

            parent.find('.faq-content').slideUp(300);

            parent.find('.faq-icon i')
                  .removeClass('fa-minus')
                  .addClass('fa-plus');

        }else{

            $('.faq-item').removeClass('active');

            $('.faq-content').slideUp(300);

            $('.faq-icon i')
                .removeClass('fa-minus')
                .addClass('fa-plus');

            parent.addClass('active');

            parent.find('.faq-content').slideDown(300);

            parent.find('.faq-icon i')
                  .removeClass('fa-plus')
                  .addClass('fa-minus');

        }

    });

});


