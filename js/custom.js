jQuery(window).load(function() {
    if(jQuery('.flexslider').length > 0) {
      jQuery('.flexslider').flexslider({
        animation: 'slide',
        slideshowSpeed: 3000,
        animationSpeed: 500,
        controlNav: false,
        prevText: '',
        nextText: '',
        touch: true
      });
    }
  });
  
  jQuery(document).ready(function () {
      // Handler for .ready() called.
      if (jQuery('body').hasClass('single-product')) {
        jQuery('html, body').animate({
          scrollTop: jQuery('.single-product-content').offset().top
        }, 'slow');
      }
      if (jQuery('body').hasClass('page-template-contacts')) {
          console.log(jQuery('.custom-page-content').offset().top - jQuery('header').outerHeight());
        jQuery('html, body').animate({
          scrollTop: jQuery('.custom-page-content').offset().top - jQuery('header').outerHeight() - 20
        }, 'slow');
      }
  
      jQuery('.socialIcon-googleplus').on('mouseover', function(){
          jQuery(this).next().find('.tooltip-inner').text('instagram');
      });

  });
  