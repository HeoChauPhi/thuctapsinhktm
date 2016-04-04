(function($) {

  function slickGallery() {
    $('.main-slick').slick({
      adaptiveHeight: true,
      infinite: true,
      fade: true,
      arrows: false,
      //autoplay: true,
      asNavFor: '.sub-slick',
      lazyLoad: 'ondemand'
      //speed: 300  
    });
    
    $('.sub-slick').slick({
      asNavFor: '.main-slick',
      arrows: false,
      slidesToScroll: 1,
      //autoplay: true,
      //speed: 300,
      focusOnSelect: true,
      infinite: true,
      slidesToShow: 4
    });
  }

  function LoadIframe() {
    $('.video-colorbox').click(function() {
      $('.video-event-item iframe').remove();
      var link_iframe = $(this).attr('href');
      //alert(link_iframe);
      $(this).after('<iframe src=' + link_iframe + '></iframe>')
      return false;
    });
  }

  $(window).load(function(){});

  $(document).ready(function() {
    // my custom js
    /*$(".colorbox").colorbox({rel:'colorbox'});
    $(".video-colorbox").colorbox({iframe:true, innerWidth:640, innerHeight:390});*/
    
    slickGallery();
    LoadIframe();
  });
})( jQuery );