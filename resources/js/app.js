jQuery(function ($) {
  //the shrinkHeader variable is where you tell the scroll effect to start.
  var shrinkHeader = 100;
  headerShrink();
  $(window).scroll(function () {
    //console.log(scroll);
    headerShrink();
  });
  function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
  }
  function headerShrink() {
    var scroll = getCurrentScroll();
    if (scroll >= shrinkHeader) {
      $('.site-header').addClass('header-shrink');
    } else {
      $('.site-header').removeClass('header-shrink');
    }
  }

  $('.menu-has-article').hover(
    function () {
      // $('.menu-article').css({
      //   visibility: 'hidden',
      //   opacity: '0',
      //   zIndex: '-10',
      // });
      // $('.menu-article').fadeOut('slow', function () {});
      $('.menu-article').hide();
      let dataArticle = $(this).data('target');
      //console.log(dataArticle);
      $('#' + dataArticle).fadeIn('slow', function () {});
      // $('#' + dataArticle).css({
      //   visibility: 'visible',
      //   opacity: '100',
      //   zIndex: '0',
      // });
    },
    function () {
      // let dataArticle = $(this).data('target');
      // console.log(dataArticle);
      // $('#' + dataArticle).css({ visibility: 'hidden', opacity: '0' });
    }
  );

  $('.main-nav--ul > li').hover(
    function () {
      //$('#main-nav').addClass('bg-brand-bluedark bg-opacity-95');
    },
    function () {
      //$('#main-nav').removeClass('bg-brand-bluedark bg-opacity-95');
    }
  );

  // Mobile Menu
  $('#mobilemenu-open').click(function (e) {
    e.preventDefault();
    $('#mobilemenu').removeClass('translate-x-full');
    $('#mobilemenu-overlay')
      .removeClass('invisible opacity-0')
      .addClass('visible opacity-100');
    $('body').addClass('overflow-y-hidden');
  });
  $('#mobilemenu-close, #mobilemenu-overlay').click(function (e) {
    e.preventDefault();
    $('#mobilemenu').addClass('translate-x-full');
    $('#mobilemenu-overlay')
      .removeClass('visible opacity-100')
      .addClass('invisible opacity-0');
    $('body').removeClass('overflow-y-hidden');
  });
  $('#mobilemenu a').click(function (e) {
    $('#mobilemenu').addClass('translate-x-full');
    $('#mobilemenu-overlay')
      .removeClass('visible opacity-100')
      .addClass('invisible opacity-0');
    $('body').removeClass('overflow-y-hidden');
  });

  // Header Search
  $('#header-search-button').on('click', function () {
    $('#header-search').toggleClass('show');
    $('#searchform-input').val('');
    $('#searchform-input').focus();
  });
  $(window).click(function () {
    if ($('#header-search').hasClass('show')) {
      $('#header-search').removeClass('show');
      $('#searchform-input').val('');
    }
  });
  $('#header-search, #header-search-button').click(function (event) {
    event.stopPropagation();
  });

  // Accordion
  $('.collapse').click(function (e) {
    e.preventDefault();
    $('.collapse').find('input[type=checkbox]').prop('checked', false);
    $(this).find('input[type=checkbox]').prop('checked', true);
    $('html, body').scrollTop(
      $(this).offset().top - 16 - $('.site-header').outerHeight(true)
    );
  });

  $("a[href*='#']").click(function (e) {
    //e.preventDefault();
    //var urlhash = $(location).prop('hash');
    var targetEle = this.hash;
    var $targetEle = $(targetEle);
    $('html, body')
      .stop()
      .animate(
        {
          scrollTop:
            $targetEle.offset().top - 16 - $('.site-header').outerHeight(true),
        },
        500,
        'swing',
        function () {
          window.location.hash = targetEle;
        }
      );

    if ($targetEle.hasClass('collapse')) {
      //console.log('collapse');
      $('.collapse').find('input[type=checkbox]').prop('checked', false);
      $targetEle.find('input[type=checkbox]').prop('checked', true);
    }
  });
});
