jQuery(function($) {
  
  $(document).ready(function() {

    // Automatically collapse the navbar when a nav-link is clicked
    $('.navbar-collapse .nav-link:not(.dropdown-toggle)').click(function() { // do not listen to nav-links that are dropdown-toggles
      var $navbarCollapse = $(this).parents('.navbar-collapse');
      var $navbarToggler = $navbarCollapse.siblings('.navbar-toggler');
      if ($navbarToggler.css('display') !== 'none') { // collapse the navbar only when the navbar-toggler is displayed
        $navbarCollapse.collapse('hide');
      }
    });

    // Enable custom smooth-scroll and focusing logic
    $('a[href*="#"]')
      .not('[href="#"]')
      .not('[data-toggle="modal"]')
      .click(function(e) {

        // Check if the link target is on the same page
        var $link = $(this);
        if ($link[0].hostname === location.hostname && $link[0].pathname.replace(/^\//, '') === location.pathname.replace(/^\//, '')) {
          
          // Check if target element exists
          var $target = $($link[0].hash);
          if ($target.length) {
            e.preventDefault();
            $('html, body').animate({
              scrollTop: $target.offset().top
            }, 800, "swing", function () {
              window.location.hash = $link[0].hash; // add hash (#) to URL when done scrolling (default click behavior)

              // Determine the element to focus
              var $focusElement;
              if ($target.hasClass('target-offset')) {
                if ($target.is('#contact-form')) {
                  $focusElement = $target.next().find('input, select, textarea').first();
                } else {
                  $focusElement = $target.next().children('h1, h2, h3, h4, h5, h6').first();
                }
              } else {
                $focusElement = $target;
              }

              // Set focus if the element is not hidden
              if ( $focusElement.css('visibility') !== 'hidden' ) {
                $focusElement.focus();
                if ( $focusElement.is(":not(:focus)") ) {
                  $focusElement.prop('tabindex', '-1'); // adding tabindex -1 to make element focusable
                  $focusElement.focus();
                }
              }
            });
          }
        }
      });

    // Prepopulate the contact form based on the service's CTA message
    $('a[href="#contact-form"]').click(function() {
      var $link = $(this);
      $('#message_text').val($link.data('cta-message'));
    });

    // Set the variables needed for the expandable text block
    var showChars = 100;
    var ellipsesText = '...';
    var moreLinkText = 'Show more';
    var lessLinkText = 'Show less';

    // Check the text of each expandable text block and modify the HTML content
    $('.expandable-text-block').each(function() {
      var $expandableTextBlock = $(this);
      var $previewText = $expandableTextBlock.children('.preview-text');
      if ($previewText.text().length > showChars) {
        var previewTextHTML = '<span class="preview-text">' + $previewText.text().substr(0, showChars) + '</span>';
        var moreTextHTML = '<span class="more-text">' + $previewText.text().substr(showChars, $previewText.text().length - showChars) + '</span>';
        var moreEllipsesHTML = '<span class="more-ellipses">' + ellipsesText + '</span>';
        var moreLinkHTML = '<a class="more-link" href="#">' + moreLinkText + '</a>';
        var lessLinkHTML = '<a class="less-link" href="#">' + lessLinkText + '</a>';
        $expandableTextBlock.html(previewTextHTML + moreTextHTML + moreEllipsesHTML + moreLinkHTML + lessLinkHTML);
      }
    });

    // Attach an event handler function to "more links" that removes the "collapsed" class
    $('.expandable-text-block > .more-link').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).parent('.expandable-text-block').removeClass('collapsed');
    });

    // Attach an event handler function to "less links" that adds the "collapsed" class
    $('.expandable-text-block > .less-link').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).parent('.expandable-text-block').addClass('collapsed');
    });

    // After closing the Bootstrap modal, if an expandable text block was not collapsed, collapse it
    $('.modal').on('hidden.bs.modal', function (e) {
      var $expandedTextBlock = $(this).find('.expandable-text-block:not(.collapsed)');
      if ($expandedTextBlock.length) {
        $expandedTextBlock.addClass('collapsed');
      }
    });

    // Validate #message_human in real time
    $('#message_human').on('input', function () {
      var $messageHuman = $(this);
      if ($messageHuman.val() !== '5') { // check if an incorrect human verification was provided
        $messageHuman[0].setCustomValidity('Human verification is incorrect.');
      } else {
        $messageHuman[0].setCustomValidity('');
      }
    });

    // Set the validation message to be displayed for form controls in real time
    $('form.needs-validation input, form.needs-validation select, form.needs-validation textarea').on('input', function () {
      $(this).siblings('.invalid-feedback').text(this.validationMessage);
    });

    // Listen to the submit event on the <form> itself
    var $form = $('form.needs-validation');
    $form.submit(function (e) {
      e.preventDefault(); // prevents the form from reloading the page
      var $submitted = $('#submitted');
      if ($submitted.val() === '1') { // checks if the form has been submitted and the hidden value was not modified
        $form.removeClass('was-validated');
        $submitted.removeClass('is-valid');
        $submitted[0].setCustomValidity(''); // reset #submitted to valid
        if ($form[0].checkValidity() === false) {
          e.stopPropagation();
          $submitted[0].setCustomValidity('Message was not sent. Please try again.'); // set #submitted to invalid
          // Set the validation message to be displayed for form controls upon submission
          $($form.find('input, select, textarea')).each(function() {
            $(this).siblings('.invalid-feedback').text(this.validationMessage);
          });
          $form.addClass('was-validated');
        } else {
          var $submitButton = $($form.find('[type=submit]'));
          $submitButton.prop('disabled', true);
          $.post(location.href, {
            message_name: $('#message_name').val(),
            message_email: $('#message_email').val(),
            message_text: $('#message_text').val(),
            message_human: $('#message_human').val(),
            submitted: $('#submitted').val(),
            ajax_request: '1'
          }).done(function(response) {
            if (response.success === true) {
              $form[0].reset();
              $submitted.addClass('is-valid');
            } else {
                $submitted[0].setCustomValidity('Message was not sent. Please try again.'); // set #submitted to invalid
                $form.addClass('was-validated');
            }
          }).fail(function() {
            $submitted[0].setCustomValidity('Message was not sent. Please try again.'); // set #submitted to invalid
            $form.addClass('was-validated');
          }).always(function() {
            $submitButton.prop('disabled', false);
          });
        }
      } else {
        e.stopPropagation();
      }
    });

    // Parallax
    $(window).scroll(function() {
      var scrollHeight = $(this).scrollTop();
      var $parallaxBackground = $('.parallax-background');
      $parallaxBackground.each(function() {
        var offsetTop = scrollHeight * 0.2;
        $(this).css('top', offsetTop);
      });
    });

    // Function to get URL parameter values
    var getUrlParamValue = function getUrlParamValue(paramKey) {
      var paramString = window.location.search.substring(1);
      var paramPairs = paramString.split('&');

      for (var i = 0; i < paramPairs.length; i++) {
        var paramPair = paramPairs[i].split('=');
        if (paramPair[0] === paramKey) {
          return paramPair[1] === undefined ? true : decodeURIComponent(paramPair[1]);
        }
      }
    };

    // Process URL parameters
    $(window).on('load', function() {
      var cp_service = getUrlParamValue('cp_service');
      if (cp_service) {
        var $ctaButton = $('#cta-' + cp_service);
        if ($ctaButton) {
          $ctaButton.click();
        }
      }
    });

    // Back button closes the modal
    $('.modal').on('show.bs.modal', function (e) {
      var $modal = $(this);
      window.location.hash = $modal.prop('id');
      window.onhashchange = function () {
        if ( window.location.hash !== $modal.prop('id') ) {
          $modal.modal('hide');
        }
      }
    });

    $('.modal').on('hide.bs.modal', function (e) {
      var $modal = $(this);
      if ( window.location.hash === '#' + $modal.prop('id') ) {
        window.history.back();
      }
    });

  });/* $(document).ready() */

});/* jQuery() */