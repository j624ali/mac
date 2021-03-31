        $(document).ready(function(){ 


var $input = $('<div class="modal-body"><input type="text" class="form-control" placeholder="Message"></div>')

$(document).on('click', '.js-msgGroup', function () {
  $('.js-msgGroup, .js-newMsg').addClass('hide')
  $('.js-conversation').removeClass('hide')
  $('.modal-title').html('<a href="#" class="js-gotoMsgs">Back</a>')
  $input.insertBefore('.js-modalBody')
})

$(function () {
  function getRight() {
    return ($(window).width() - ($('[data-toggle="popover"]').offset().left + $('[data-toggle="popover"]').outerWidth()))
  }

  $(window).on('resize', function () {
    var instance = $('[data-toggle="popover"]').data('bs.popover')
    if (instance) {
      instance.options.viewport.padding = getRight()
    }
  })

  $('[data-toggle="popover"]').popover({
    template: '<div class="popover" role="tooltip"><div class="arrow"></div><div class="popover-content p-x-0"></div></div>',
    title: '',
    html: true,
    trigger: 'manual',
    placement:'bottom',
    viewport: {
      selector: 'body',
      padding: getRight()
    },
    content: function () {
      var $nav = $('.app-navbar .navbar-nav:last-child').clone()
      return '<div class="nav nav-stacked" style="width: 200px">' + $nav.html() + '</div>'
    }
  })

  $('[data-toggle="popover"]').on('click', function (e) {
    e.stopPropagation()

    if ($('[data-toggle="popover"]').data('bs.popover').tip().hasClass('in')) {
      $('[data-toggle="popover"]').popover('hide')
      $(document).off('click.app.popover')

    } else {
      $('[data-toggle="popover"]').popover('show')

      setTimeout(function () {
        $(document).one('click.app.popover', function () {
          $('[data-toggle="popover"]').popover('hide')
        })
      }, 1)
    }
  })

})

$(document).on('click', '.js-gotoMsgs', function () {
  $input.remove()
  $('.js-conversation').addClass('hide')
  $('.js-msgGroup, .js-newMsg').removeClass('hide')
  $('.modal-title').html('Messages')
})

$(document).on('click', '[data-action=growl]', function (e) {
  e.preventDefault()

  $('#app-growl').append(
    '<div class="alert alert-dark alert-dismissible fade in" role="alert">'+
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
        '<span aria-hidden="true">×</span>'+
      '</button>'+
      '<p>Click the x on the upper right to dismiss this little thing. Or click growl again to show more growls.</p>'+
    '</div>'
  )
})

$(document).on('focus', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    $(this).animate({
      width: 300
    })
  }
})

$(document).on('blur', '[data-action="grow"]', function () {
  if ($(window).width() > 1000) {
    var $this = $(this).animate({
      width: 180
    })
  }
})

// back to top button - docs
$(function () {
  if ($('.docs-top').length) {
    _backToTopButton()
    $(window).on('scroll', _backToTopButton)
    function _backToTopButton () {
      if ($(window).scrollTop() > $(window).height()) {
        $('.docs-top').fadeIn()
      } else {
        $('.docs-top').fadeOut()
      }
    }
  }
})

$(function () {
    // doc nav js
    var $toc    = $('#markdown-toc')
    var $window = $(window)

    if ($toc[0]) {

      maybeActivateDocNavigation()
      $window.on('resize', maybeActivateDocNavigation)

      function maybeActivateDocNavigation () {
        if ($window.width() > 768) {
          activateDocNavigation()
        } else {
          deactivateDocNavigation()
        }
      }

      function deactivateDocNavigation() {
        $window.off('resize.theme.nav')
        $window.off('scroll.theme.nav')
        $toc.css({
          position: '',
          left: '',
          top: ''
        })
      }

      function activateDocNavigation() {

        var cache = {}

        function updateCache() {
          cache.containerTop   = $('.docs-content').offset().top - 40
          cache.containerRight = $('.docs-content').offset().left + $('.docs-content').width() + 45
          measure()
        }

        function measure() {
          var scrollTop = $window.scrollTop()
          var distance =  Math.max(scrollTop - cache.containerTop, 0)

          if (!distance) {
            $($toc.find('li')[1]).addClass('active')
            return $toc.css({
              position: '',
              left: '',
              top: ''
            })
          }

          $toc.css({
            position: 'fixed',
            left: cache.containerRight,
            top: 40
          })
        }

        updateCache()

        $(window)
          .on('resize.theme.nav', updateCache)
          .on('scroll.theme.nav', measure)

        $('body').scrollspy({
          target: '#markdown-toc',
          selector: 'li > a'
        })

        setTimeout(function () {
          $('body').scrollspy('refresh')
        }, 1000)
      }
    }
})














// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button
// Floating Button


 // build script hook - don't remove
 ;(function ( window, document, undefined ) {
 

  'use strict';

  /**
   * Some defaults
   */
  var clickOpt = 'click',
      hoverOpt = 'hover',
      toggleMethod = 'data-mfb-toggle',
      menuState = 'data-mfb-state',
      isOpen = 'open',
      isClosed = 'closed',
      mainButtonClass = 'mfb-component__button--main';

  /**
   * Internal references
   */
  var elemsToClick,
      elemsToHover,
      mainButton,
      target,
      currentState;

  /**
   * For every menu we need to get the main button and attach the appropriate evt.
   */
  function attachEvt( elems, evt ){
    for( var i = 0, len = elems.length; i < len; i++ ){
      mainButton = elems[i].querySelector('.' + mainButtonClass);
      mainButton.addEventListener( evt , toggleButton, false);
    }
  }

  /**
   * Remove the hover option, set a click toggle and a default,
   * initial state of 'closed' to menu that's been targeted.
   */
  function replaceAttrs( elems ){
    for( var i = 0, len = elems.length; i < len; i++ ){
      elems[i].setAttribute( toggleMethod, clickOpt );
      elems[i].setAttribute( menuState, isClosed );
    }
  }

  function getElemsByToggleMethod( selector ){
    return document.querySelectorAll('[' + toggleMethod + '="' + selector + '"]');
  }

  /**
   * The open/close action is performed by toggling an attribute
   * on the menu main element.
   *
   * First, check if the target is the menu itself. If it's a child
   * keep walking up the tree until we found the main element
   * where we can toggle the state.
   */
  function toggleButton( evt ){

    target = evt.target;
    while ( target && !target.getAttribute( toggleMethod ) ){
      target = target.parentNode;
      if(!target) { return; }
    }

    currentState = target.getAttribute( menuState ) === isOpen ? isClosed : isOpen;

    target.setAttribute(menuState, currentState);

  }

  /**
   * On touch enabled devices we assume that no hover state is possible.
   * So, we get the menu with hover action configured and we set it up
   * in order to make it usable with tap/click.
   **/
  if ( window.Modernizr && Modernizr.touch ){
    elemsToHover = getElemsByToggleMethod( hoverOpt );
    replaceAttrs( elemsToHover );
  }

  elemsToClick = getElemsByToggleMethod( clickOpt );

  attachEvt( elemsToClick, 'click' );

// build script hook - don't remove
})( window, document );







// $("form").submit(function(event){
          
//           event.preventDefault();
          


//           var username_email = $("#username_email").val();
//           var password = $("#password").val();



          
//           $("#error").load("login.php", {
             
//               password: password,
//               username_email: username_email
              
              
//           });
//         });









 });