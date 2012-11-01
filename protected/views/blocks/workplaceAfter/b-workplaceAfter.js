$(function($){        
  $('body').on('click','.workplace__finish',function(){
    Sync.add_message({
      module: 'navigation',
      data: 'finish'
    });
    $(this).html('Завершение...');
    
    // для того, чтобы  перед редиректом 
    // сообщение успело отправиться партнёру
    setTimeout(send,1000); 
    return false;
  });
  
  function send(){
    $.ajax({
      'type':   'POST',
      'data': {
        'lesson_id': $('#lesson_id').val()
      },
      'url':  '  lesson/finish',
      'cache':   false,
      'success': function(html){
        window.location.assign('/afterLesson');
      },
      'dataType':'html'
    });
  }
});