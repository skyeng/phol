$(function(){
  function translate(lang){
    $.ajax({
      'type':'POST',
      'url':'tool/translate',
      'data':{
        'word':$('.translator__frame').val(),
        'lang':lang,
      },
      'cache':false,
      'success':function(data){
        var obj = $.parseJSON(data);
        $('.translator__translation').html('<p>'+obj.text+'</p>');
        if(obj.lang == 'ru')
          $('.translator__language-change').html('<p>ru-en</p><p><a href="" class="translator__lang_en">en-ru</a></p>');
        else if(obj.lang == 'en')
          $('.translator__language-change').html('<p><a href="" class="translator__lang_ru">ru-en</a></p><p>en-ru</p>');
      },
      'dataType':'html'
    });  
  }

  var timeout=null;

  function translate_wr(){
    clearTimeout(timeout);
    timeout = setTimeout(function(){translate('auto')},500);
  }


  $('body').on('keyup','.translator__frame',function(){translate_wr();});
  $('body').on('click','.translator__lang_ru',function(){translate('ru');return false;});
  $('body').on('click','.translator__lang_en',function(){translate('en');return false;});      
});