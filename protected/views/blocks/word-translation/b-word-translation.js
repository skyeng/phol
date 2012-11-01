$(function(){
  $(document).bind('word/selected', function(event, data){
    var word = data.word.toLowerCase();
    // $(document).trigger('word/click', {word: word});
    //console.log('CLICK: ', word);
    if($('#isTeacher').val() == 'teacher'){
      $('.b-word-translation__queue').append(word+'<br />');
      add_message({
        module: 'navigation',
        data  : {
          'event':'add_word',
          'word' : word,
        }
      });
      $.ajax({
        'type':'POST',
        'data':{
          'word':word
        },
        'url'  : 'tool/dictionary',
        'cache': false
      });
    }else{
      $.ajax({
        'type'   :'POST',
        'data'   :{'word':word},
        'url'    :'tool/getWordInfo',
        'cache'  :false,
        'success':function(data){
          $('.b-word-translation__word').html(word);
          if(data.error == 'not found'){
            $('.b-word-translation__transcription').empty();
            $('.b-word-translation__translation').html('not found');
            $('.b-word-translation__more-translations-list').empty();
            //картинка и звук - добавить
          }else{
            $('.b-word-translation__transcription').html('['+data.transcription+']');
            $('.b-word-translation__translation').html(data.translation);
            $('.b-word-translation__more-translations-list').empty();
            for(i=0; i<data.translations.length; i++)
              $('.b-word-translation__more-translations-list').append('<li class="b-word-translation__more-translations-element"><a href="#"><t>'+data.translations[i]+'</t></a></li>');
            //картинка и звук - добавить
          }
          $('.b-word-translation').show();
        },
        'dataType':'json',
      });  
    }
  });


  $('body').on('click','.b-word-translation__add-button',function(){
    var word = $('.b-word-translation__word').html();
    var translation = $('.b-word-translation__translation').html();
    // $('.b-word-translation__queue').append(word+' ('+translation+')<br />');
    add_message({
      module: 'navigation',
      data: {
        'event':'add_word',
        'word':word,
        'translation':translation
      }
    });
    $.ajax({
      'type':'POST',
      'data':{
        'word':word,
        'translation':translation
      },
      'url':'tool/dictionary',
      'cache':false,
      'success':function(html){
        console.log('word: added - '+html);
        $('.b-word-translation').hide();
      },
      'error':function(html){console.log('word: error - '+html);}
    }).done(function(){
      $(document).trigger('word/new/add', {word: word});
    });
    return false;
  });
  $('body').on('click','.b-word-translation__more-translations-element a t',function(){
    $('.b-word-translation__more-translations-element').removeClass('b-word-translation__more-translations-element-active');
    $('.b-word-translation__translation').html($(this).html());
    $(this).parent().parent().addClass('b-word-translation__more-translations-element-active');
    return false;
  });  
});