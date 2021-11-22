
const bootstrap = require('bootstrap');
// as the page loads, call these scripts
var $ = jQuery.noConflict();
$(document).ready(function() {
  var templateUrl = vars.templateUrl;

  if (typeof imagesLoaded == 'function') { 
    var scroll;
    var prev;
    var prevP;

    var $grid = $('.portfolio-feed').imagesLoaded(function () {
      $grid.masonry({ 
        percentPosition: true,
        itemSelector: '.portfolio-entry',
        stagger: 0,
        transitionDuration: '0.55s',
        columnWidth: '.no-gutter-grid-sizer'
      });

      var waypoints = $('.portfolio-entry').waypoint(function(direction) {
        // notify(this.element.id + ' hit 25% from top of window') 
        $(this.element).addClass('animate-it');
      }, {
        offset: '95%'
      })
    });

  }

  $(".portfolio-entry-inner").hover(function() {
      $(this).children(".overlay").addClass("hover")
  }, function() {
      $(this).children(".overlay").removeClass("hover")
  });

  // $('[data-toggle="popover-top"]').popover();

  if (window.matchMedia("(max-width: 768px)").matches) {
    $('.dropdown-toggle').dropdown();
  }
  var entryCss = '';
  $('.portfolio-entry').each(function(index) {
    var color = $(this).find('.overlay').attr('data-bg');
    entryCss += '.portfolio-entry-'+index+' .overlay:before {'
      +'background-color: '+color+ ';'
      + '}';
  });
  $('body').append('<style type="text/css">'+entryCss+'</style>');

  var bodyWidth = $(".js-force-full-width").parent().width();
  //get the window's width
  var windowWidth =$(window).width();

  //set the full width div's width to the body's width, which is always full screen width
  $(".js-force-full-width").css({"width": $("body").width() + "px"});
  //setting margin for aligning full width div to the left
  //only needed when content area width is smaller than screen width
  if(windowWidth>bodyWidth){
    var marginLeft = -(windowWidth - bodyWidth)/2;

    $(".js-force-full-width").css({"margin-left": marginLeft+"px"});
  }

  // handling changing screen size
  $(window).resize( function(){
      $(".js-force-full-width").css({"width": $("body").width() + "px"});
      if(windowWidth>bodyWidth){
          $(".js-force-full-width").css({"margin-left": (-($(window).width() - $(".js-force-full-width").parent().width())/2)+"px"});
      } else{
          $(".js-force-full-width").css({"margin-left": "0px"});
      }
  });


  var navOffset = 60;
  // Animated Scroll to event Add id to target
  var urlHash = window.location.href.split("#")[1];
  // console.log('urlHash ' + urlHash);
  var regex = /(gallery\[rel)/g;

  if (typeof urlHash != 'undefined' && urlHash != '' && !urlHash.match(regex)) {
    if ($('.' + urlHash + ', #' + urlHash +',[name='+urlHash+']').length) {
      var target = $('.' + urlHash + ', #' + urlHash +',[name='+urlHash+']');
    }

    if (typeof target != 'undefined' && $(target)) {
      $('html,body').animate({
          scrollTop: target.first().offset().top -100
      }, 1000);
    }
  }


  $(".menu-item li.scroll a").on('click', function(event) {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      // var target = document.getElementById(this.hash);
      // check if the target exists first
      if (typeof target != 'undefined' && target != '') {
        if (target.length) {
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        }
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top - navOffset
          }, 1000);
          return false;
          // return window.history.pushState(null, null, target);  
        }
      }
    }

  });


});