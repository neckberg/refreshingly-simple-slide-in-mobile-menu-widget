jQuery(document).ready(function($) {
  $.ajax({
    type: 'get',
    url: psmmw_script_vars.ajax_url,  // wp-json/psmmw/v1/html
    success: function(data) {
      let html_body = $('body');
      html_body.prepend(data['hamburger'] + data['backdrop'] + data['drawer']);
      let css_class_open = 'psmmw-drawer-open';
      $('.psmmw-hamburger-bar > .psmmw-icon').click(
        function() {
          if (html_body.hasClass(css_class_open)) {
            html_body.removeClass(css_class_open)
          }
          else {
            html_body.addClass(css_class_open)
          }
        }
      );
      $('.psmmw-drawer-close, .psmmw-backdrop').click(
        function() {
          html_body.removeClass(css_class_open)
        }
      );

    },
    error: function(error) {
      console.log(error);
    }
  });
});
