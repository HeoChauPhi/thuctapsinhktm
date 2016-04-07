(function($) {

  function SearchPostAjax() {
    /*$('input.add_post').on('click', function() {
      console.log('heochaua');
    });*/

    if($('input.add_post').parent('.edit_form_line').has('ul.dhemy-ajax-search')){
      console.log('yes');
    } else {
      console.log('no');
    }
    $('input.add_post').parent('.edit_form_line').has('ul.dhemy-ajax-search').empty();

    $('input.add_post').keypress(function(event) {
      // prevent browser autocomplete
      //$(this).attr('autocomplete','on');
      // get search term
      var searchTerm = $(this).val();

      // send request when the lenght is gt 2 letters
      if(searchTerm.length > 0){
        console.log('ok');
        $.ajax({
          url : BASE+'/wp-admin/admin-ajax.php',
          type:"POST",
          data:{
            'action':'dhemy_ajax_search',
            'term' :searchTerm
          },
          success:function(result){
            $(this).next('.dhemy-ajax-search').empty();
            $('.dhemy-ajax-search').fadeIn().html(result);
          }
        });
      } else if(searchTerm.length == 0) {
        $('input.add_post').next('.dhemy-ajax-search').empty();
      }
    });
  }

  $(window).load(function(){});

  $(document).ready(function() {});

  $(document).ajaxComplete(function() {
    SearchPostAjax();
  });
})( jQuery );
