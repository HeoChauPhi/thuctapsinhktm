(function($) {

  function test_script() {
    $('input.add_post').click(function() {
      console.log('heochaua');
    });
  }

  $(window).load(function(){});

  $(document).ready(function() {});

  $(document).ajaxComplete(function() {    
    test_script();
  });
})( jQuery );