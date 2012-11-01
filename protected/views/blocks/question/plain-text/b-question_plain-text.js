$(function(){
  $('.question__plain-text').wordWrap(function(data){
    $(document).trigger('word/selected', {
      word: data.word
    });
  });
});