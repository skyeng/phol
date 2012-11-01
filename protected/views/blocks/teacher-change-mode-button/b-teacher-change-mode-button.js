$(function() {
  var mode = 'teacher-comment-view',  // Mode to begin with
    alt_mode = 'student-view';        // Alternative mode
  // Broadcast initial mode
  $(document).trigger('set/view-mode/teacher', {mode: mode} );

  // Set button values
  $but = $('.b-teacher-change-mode-button__switch');
  $but
    .data({
      cur_mode:  alt_mode,      // Set current and alternative modes
      next_mode: mode
    })
    .html($but.data(mode)) ;  // Set caption



  $but.click(function() {
    var data = $but.data();
    console.log(data);
    $but
      .data({
        cur_mode:  data.next_mode,  // Exchange cur and alt modes
        next_mode: data.cur_mode
      })
      .html($but.data(data.next_mode) )   // Change caption
     
    // broadcast mode changing
    $(document).trigger('set/view-mode/teacher', {mode: data.next_mode} );
  });
});
