jQuery(document).ready(function($) {
  // alert( pw_script_vars.alert );
	console.log( pw_script_vars.ajax_url );
});

jQuery(document).ready(function($) {
  $.ajax({
    type: 'get',
    url: pw_script_vars.ajax_url,  // wp-json/psmmw/v1/html
    success: function(data) {
      // console.log(data);
      // $('body').prepend(data['html']);
      $('body').prepend(data['hamburger'] + data['backdrop'] + data['drawer']);
      // let drawer = $('.psmmw-mobile-drawer');
      let hamburger = $('.psmmw-hamburger');
      // $('.psmmw-hamburger').click(
      hamburger.click(
        function() {
          if (hamburger.hasClass('open')) {
            hamburger.removeClass('open')
          }
          else {
            hamburger.addClass('open')
          }
        }
      );
      $('.psmmw-drawer-close').click(
        function() {
          hamburger.removeClass('open')
        }
      );

    },
    error: function(error) {
      console.log(error);
    }
  });
});
