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

// Roadmap: chevrons are a static scroll-reveal flow (see wow.js init
// below); the step detail lives in a laptop-frame slider synced to them.
var $laptopSlides = $('.laptop-slides');
if ($laptopSlides.length) {
    $laptopSlides.owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 4500,
        autoplayHoverPause: true,
        smartSpeed: 500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: [
            '<i class="fa fa-long-arrow-left"></i>',
            '<i class="fa fa-long-arrow-right"></i>'
        ]
    });

    var $steps = $('.process-step');

    function setActiveStep(index) {
        $steps.removeClass('is-active').eq(index).addClass('is-active');
    }
    setActiveStep(0);

    $laptopSlides.on('changed.owl.carousel', function (e) {
        if (!e.namespace) return;
        setActiveStep(e.item.index % e.item.count);
    });

    $steps.on('click', function () {
        var target = $(this).data('slide-target');
        $laptopSlides.trigger('to.owl.carousel', [target, 400, true]);
        setActiveStep(target);
    });
}



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
    dots: true,

    autoplay: true,
    autoplayTimeout: 3500,
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

$('.tablets-carousel').owlCarousel({

    loop: false,

    margin: 28,

    nav: true,

    dots: true,

    autoplay: true,

    autoplayTimeout: 3500,

    smartSpeed: 700,

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
// Problem & Solution Sliders (Service details page)
//=====================================

$('.problem-carousel, .solution-carousel').owlCarousel({

    items: 1,

    loop: false,

    nav: false,

    dots: true,

    autoplay: true,

    autoplayTimeout: 4000,

    smartSpeed: 600,

    animateIn: 'fadeIn',

    animateOut: 'fadeOut',

    autoplayHoverPause: true

});

//=====================================
// Child Services Slider (Service details page)
//=====================================

$('.child-services-carousel').owlCarousel({

    items: 1,

    loop: false,

    nav: true,

    navText: [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>'
    ],

    dots: true,

    autoplay: false,

    smartSpeed: 600,

    animateIn: 'fadeIn',

    animateOut: 'fadeOut'

});

//=====================================
// Office Culture Slider (About page)
//=====================================

$('.office-culture-slider').owlCarousel({

    items: 1,

    loop: true,

    nav: false,

    dots: true,

    autoplay: true,

    autoplayTimeout: 3500,

    smartSpeed: 700,

    animateIn: 'fadeIn',

    animateOut: 'fadeOut',

    autoplayHoverPause: true

});

//=====================================
// Testimonials Carousel
//=====================================

$('.testimonials-carousel').owlCarousel({

    items:1,

    loop:true,

    margin:30,

    nav:true,

    navText: [
        '<i class="fa fa-long-arrow-left"></i>',
        '<i class="fa fa-long-arrow-right"></i>'
    ],

    dots:true,

    autoplay:true,

    autoplayTimeout:4500,

    autoplaySpeed:1000,

    smartSpeed:600,

    animateIn:'fadeIn',

    animateOut:'fadeOut',

    autoplayHoverPause:true

});

//=====================================
// Team / Industries Phone Carousel
//=====================================

$('.phones-carousel').owlCarousel({

    loop:false,

    margin:24,

    nav:true,

    navText: [
        '<i class="fa fa-long-arrow-left"></i>',
        '<i class="fa fa-long-arrow-right"></i>'
    ],

    dots:true,

    autoplay:true,

    autoplayTimeout:4000,

    smartSpeed:600,

    autoplayHoverPause:true,

    responsive:{
        0:{
            items:1
        },
        992:{
            items:3
        }
    }

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

//=====================================
// Contact forms (home page + /contact page)
// client-side validation + real AJAX submit to /contact
//=====================================

$(document).ready(function () {

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function validateField($field) {
        var el = $field.get(0);
        var $group = $field.closest('.app-form-group');
        var valid = el.checkValidity();

        $group.toggleClass('has-error', !valid);
        $group.toggleClass('is-valid', valid && $field.val().trim() !== '');

        return valid;
    }

    function showFormMessage($form, isSuccess, message) {
        var $box = $form.find('.app-form-success');
        $box.find('i').attr('class', isSuccess ? 'fa fa-check-circle' : 'fa fa-times-circle')
            .css('color', isSuccess ? '#22c07a' : '#e04b4b');
        $box.find('p').text(message);
        $form.addClass('is-submitted');

        setTimeout(function () {
            $form.removeClass('is-submitted');
        }, 4000);
    }

    // Scoped per-form so multiple .app-contact-form instances on the
    // same page (e.g. a modal form + a page-level form) don't cross-
    // trigger each other's shake/loading/reset state.
    $('.app-contact-form').each(function () {
        var $form = $(this);

        $form.find('input, textarea').on('blur input', function () {
            validateField($(this));
        });

        $form.on('submit', function (e) {
            e.preventDefault();

            var allValid = true;
            var $firstInvalid = null;

            $form.find('input, textarea').each(function () {
                var $field = $(this);
                if (!validateField($field)) {
                    allValid = false;
                    if (!$firstInvalid) $firstInvalid = $field;
                }
            });

            if (!allValid) {
                $form.addClass('shake');
                setTimeout(function () { $form.removeClass('shake'); }, 500);
                if ($firstInvalid) $firstInvalid.trigger('focus');
                return;
            }

            var $btn = $form.find('.app-form-submit');
            $btn.addClass('is-loading').prop('disabled', true);

            // Forms without a real action (e.g. the career "general
            // application" widgets, which post different fields and
            // aren't wired to a backend yet) keep the old harmless
            // simulated submit instead of AJAX-posting nowhere useful.
            if (!$form.attr('action')) {
                setTimeout(function () {
                    $btn.removeClass('is-loading').prop('disabled', false);
                    showFormMessage($form, true, 'Thanks! Your message has been noted.');
                    $form.find('input, textarea').val('');
                    $form.find('.app-form-group').removeClass('is-valid has-error');
                }, 900);
                return;
            }

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                data: {
                    name: $form.find('[name="name"]').val(),
                    email: $form.find('[name="email"]').val(),
                    phone: $form.find('[name="phone"]').val(),
                    message: $form.find('[name="message"]').val()
                }
            }).done(function (response) {
                $btn.removeClass('is-loading').prop('disabled', false);
                showFormMessage($form, true, response.message || 'Thanks! Your message has been noted.');
                $form.find('input, textarea').val('');
                $form.find('.app-form-group').removeClass('is-valid has-error');
            }).fail(function (xhr) {
                $btn.removeClass('is-loading').prop('disabled', false);
                var message = (xhr.responseJSON && xhr.responseJSON.message) || 'Something went wrong. Please try again.';
                showFormMessage($form, false, message);
            });
        });
    });

    //=====================================
    // Newsletter subscribe forms (home page + footer)
    //=====================================
    $('.app-newsletter-form').each(function () {
        var $form = $(this);
        var $result = $form.next('.subscribe-result, .mt-10.info');
        var $btn = $form.find('button[type="submit"]');

        $form.on('submit', function (e) {
            e.preventDefault();

            var $email = $form.find('input[type="email"]');

            if (!$email.get(0).checkValidity()) {
                $email.trigger('focus');
                return;
            }

            $btn.prop('disabled', true);

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                data: {
                    email: $email.val(),
                    name: $form.find('input[name="name"]').val()
                }
            }).done(function (response) {
                $btn.prop('disabled', false);
                $result.css('color', '#22c07a').text(response.message || 'Thanks for subscribing!');
                $email.val('');
            }).fail(function (xhr) {
                $btn.prop('disabled', false);
                var message = (xhr.responseJSON && xhr.responseJSON.message) || 'Something went wrong. Please try again.';
                $result.css('color', '#e04b4b').text(message);
            });
        });
    });

});


