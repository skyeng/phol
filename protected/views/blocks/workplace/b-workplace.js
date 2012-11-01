$(function(){
  // Hide/show teacher comments
  //$('com').hide();
  var teacher_specific = 'com, teacher, explain';
  $(document).bind('set/view-mode/teacher', function(event, data) {
    console.log(data.mode);
    switch(data.mode){
      case 'teacher-comment-view':
        $(teacher_specific).show();
        break;
      default:
        $(teacher_specific).hide();
    }
  });
});

