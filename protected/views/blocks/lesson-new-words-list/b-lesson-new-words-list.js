$(function() {
  // Toggle speaker icon near the word
  $ul = $("ul.b-lesson-new-words-list__list")
    .on('mouseenter', 'li', function(){
      $(this).find("img").animate({
        opacity:  1,
      }, 100);
    })
    .on('mouseleave', 'li', function(){
      $(this).find("img").animate({
        opacity:  0,
      }, 100);
    })
    .on('click', 'img',function(event){
      event.preventDefault();
      var word = $(this)
        .closest('a')
        .find('audio');
      $(word)[0].play();

      //console.log(word);
      // playSound('http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=' + word);
    });

  // Add new word after to the word list
  $(document).bind('word/new/add', function(event, data) {
    // Take first (template) element 
    $('li.b-lesson-new-words-list__element:first')
      .clone()
      .hide()
      .appendTo($ul)
      .find('a.b-lesson-new-words-list__word')
      .html(data.word)
      .parent()
      .fadeToggle()
      .trigger('check/wordlist');
  });

  // Hide word list if no word; show if any.
  $wordlist = $('.b-lesson-new-words-list__holder');
  $(document).bind('check/wordlist', function() {
    if($ul.children().length == 1) // 1st element is a template
         $wordlist.hide();
    else $wordlist.show();
  });

  // Hide list if needed right after page loads
  $(document).trigger('check/wordlist');
});