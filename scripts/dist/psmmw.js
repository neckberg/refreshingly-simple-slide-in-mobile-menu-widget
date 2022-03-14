jQuery(document).ready(function($) {
  // alert( pw_script_vars.alert );
	console.log( pw_script_vars.ajax_url );
});

jQuery(document).ready(function($) {
  $.ajax({
    type: 'get',
    url: pw_script_vars.ajax_url,  // wp-json/psmmw/v1/html
    success: function(data) {
      console.log(data);
      $('body').prepend(data[1]);
      $('body').prepend(data[0]);
      let drawer = $('.psmmw-mobile-drawer');
      $('.psmmw-hamburger').click(
        function() {
          console.log('hey');
          if (drawer.hasClass('open')) {
            drawer.removeClass('open')
          }
          else {
            drawer.addClass('open')
          }
        }
      );
      $('.psmmw-drawer-close').click(
        function() {
          console.log('hey');
          drawer.removeClass('open')
        }
      );

    },
    error: function(error) {
      console.log(error);
    }
  });
});
