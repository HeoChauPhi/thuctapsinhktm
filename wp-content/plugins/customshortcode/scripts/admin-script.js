(function($) {

  function AddMarkupSearch() {
    var TextSearch = $('.vc_shortcode-param').find('input[type*="text"]');
    TextSearch.one( "focus", function() {
      if ($(this).next('.dhemy-ajax-search').lenght > 0){
        console.log('remove');
        $(this).next('.dhemy-ajax-search').remove();
      } else {
        console.log('add');
        $(this).after('<ul class="dhemy-ajax-search"></ul>');
      }

    });
    //TextSearch.hasClass('add_post').after('<ul class="dhemy-ajax-search"></ul>');
  }

  function SearchPostAjax() {
    /*$('input.add_post').on('click', function() {
      console.log('heochaua');
    });*/
    //$('.dhemy-ajax-search').empty();

    $('input.add_post').keypress(function(event) {
      // prevent browser autocomplete
      //$(this).attr('autocomplete','on');
      // get search term
      var searchTerm = $(this).val();

      // send request when the lenght is gt 2 letters
      if(searchTerm.length > 0){
        $.ajax({
          url : BASE+'/wp-admin/admin-ajax.php',
          type:"POST",
          data:{
            'action':'dhemy_ajax_search',
            'term' :searchTerm
          },
          success:function(result){
            $(this).next('.dhemy-ajax-search').empty();
            $(this).next('.dhemy-ajax-search').html(result);
          }
        });
      } else if(searchTerm.length == 0) {
        $('input.add_post').next('.dhemy-ajax-search').empty();
      }
    });
  }

  $(window).load(function(){
    SearchPostAjax();
    AddMarkupSearch();
  });

  $(document).ready(function() {
  });

  $(document).ajaxStart(function() {
    AddMarkupSearch();
    //SearchPostAjax();
  });
})( jQuery );
