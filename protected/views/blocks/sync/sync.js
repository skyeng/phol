var messages = [];
var queue = [[],[],[],[]];
var tmp_delivery = [];
var sync_interval;
var received_packets = [];

function add_message(m){
  var time = new Date();
  var rnd  = Math.floor(Math.random()*899 + 100);
  var message ={
    m: m.module,
    d: m.data
  }
  //m.key  = time.getTime()+'_'+rnd;
  messages.push(message);
}

function add_or_update_message(m, func){
  for(i=0; i<messages.length; i++)
    if( func(messages[i], m) ){
      messages[i] = m;
      return 'updated';
    }
  add_message(m);
  return 'added';
}

function clear_messages () {
  messages = [];
  //console.log("Messages cleaned");
}

function deleteByKey(key){
  for(i=0; i<queue.length; i++)
      for(j=0; j<queue[i].length; j++)
        if(queue[i][j] != null && queue[i][j].key == key)
          queue[i][j] = null;
  
}

// packet template:
// {
//   g: {                  // global info
//     r: [                // inform servers about received packets
//       123,              // received packets numbers
//       342,
//       234,
//       ...
//     ],
//     t: "2012-12-21 12:00:00" // timestamp
//   },

//   m: [                    // messages
//     {
//       m: "tracking"       // module name
//       d: {                // message module data
//         ...
//       }
//     },
//     ...
//   ]
// }



function send_messages () {
  var global_info = {
    r: received_packets,
    t: new Date().getTime()
  }
  received_packets = [];

  $.ajax({
    url: '/ping.php',
    type: 'post',
    data: {json: JSON.stringify({
      g: global_info,
      m: messages
    })},
    dataType: 'json',
    success: function(data) {
      received_packets.push(data.g.n);
      parse_messages(data.m);
    },
     error: function(){
       console.log('error');
     }
  });
}

function parse_messages(messages) {
  //console.log("Parsing messages");
  //console.log(messages);
  $.each(messages, function(i, message){
    // if(message.m == 'delivery'){
    //   if(message.d.status == 'acepted')
    //     deleteByKey(message.d.key);
    // }else
    $(document).trigger("sync/"+message.m, [message.d]);
    // tmp_delivery.push({
    //   m:'delivery',
    //   d:{
    //     status: 'acepted',
    //     key:message.key
    //   }
    // });
  });
}

function moveFromQueue(){
  var tmp = queue.shift();
  for(i=0; i<tmp.length; i++)
    if(tmp[i] != null)
      add_message(tmp[i]);
}

function moveToQueue(){
  queue.push(messages);
  messages = [];
  for(i=0; i<tmp_delivery.length; i++)
    add_message(tmp_delivery[i]);
  tmp_delivery = [];
}

function sync_routine(){
  moveFromQueue();
  send_messages();
  moveToQueue();
}

Sync = {};
Sync.add_message = add_message;
Sync.add_or_update_message = add_or_update_message;

$(function(){
  $('.sync__button').click(function(event){
    event.preventDefault();
    sync_routine();
  });
});
// $(function(){
//   sync_interval = window.setInterval(sync_routine, 500);
// });