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
      let hamburger_bar= $('.psmmw-hamburger-bar');
      // $('.psmmw-hamburger-bar').click(
      $('.psmmw-hamburger-bar > .psmmw-icon').click(
        function() {
          if (hamburger_bar.hasClass('open')) {
            hamburger_bar.removeClass('open')
          }
          else {
            hamburger_bar.addClass('open')
          }
        }
      );
      $('.psmmw-drawer-close, .psmmw-backdrop').click(
        function() {
          hamburger_bar.removeClass('open')
        }
      );

    },
    error: function(error) {
      console.log(error);
    }
  });
});
