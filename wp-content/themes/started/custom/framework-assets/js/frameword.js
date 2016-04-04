jQuery(document).ready(function($) {
	// my custom js
  pathArray = location.href.split( '/' );
  protocol = pathArray[0];
  host = pathArray[2];
  url = protocol + '//' + host;
  $('.support-online-widget .supporter-skype img').attr('src', url + '/wp-content/themes/started/custom/framework-assets/images/skype-master.png');

  /*$(".block-search .search").hide();
  $(".block-search .toggle-search").click(function(){
    $(this).toggleClass("open");
    $(this).toggleClass("close");
    $(".block-search .search").slideToggle();
  });*/

  $('.um-profile.um-editing .um-profile-body .um-row-heading').each(function(){
    $(this).click(function(){
      $(this).toggleClass('show');
      $(this).next('.um-row').slideToggle();
    });

    /*if( $(this).next('.um-row').find('.um-field-area input:last-of-type').val().length == 0 ) {
      $(this).parents('.um-row').addClass('warning');
    }*/
  });
});
