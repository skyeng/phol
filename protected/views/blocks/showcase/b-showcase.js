$(function() {
  function slideSwitch() {
    var $active = $('#showcase__slideshow IMG.showcase__slideshow-active');

    if ( $active.length == 0 ) $active = $('#showcase__slideshow IMG:last');

    // use this to pull the images in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
      : $('#showcase__slideshow IMG:first');

    // uncomment the 3 lines below to pull the images in random order
    
    var $sibs  = $active.siblings();
    var rndNum = Math.floor(Math.random() * $sibs.length );
    var $next  = $( $sibs[ rndNum ] );


    $active.addClass('showcase__slideshow-last-active');

    $next.css({opacity: 0.0})
      .addClass('showcase__slideshow-active')
      .animate({opacity: 1.0}, 1000, function() {
        $active.removeClass('showcase__slideshow-active showcase__slideshow-last-active');
      });
  }


  setInterval( "slideSwitch()", 5000);

  $('.showcase__apply').click( function(){
    $('.order').css('z-index','3');
    $('.black__screen').css('z-index','2').animate({opacity: '0.3'},100);
    $.scrollTo('.order__box',800,{offset:-100});
    $('.order input:first').focus();
    return false;
  });
  $('.black__screen').click( function(){
    $('.black__screen').css('opacity','0').css('z-index','0');
    $('.order').css('z-index','auto');
    return false;
  });
});