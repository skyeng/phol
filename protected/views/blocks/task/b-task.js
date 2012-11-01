$(function(){
  $('.task').wordWrap(function(data){
    $(document).trigger('word/selected', {
      word: data.word
    });
  });
});