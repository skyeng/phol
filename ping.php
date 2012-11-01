<?

//********************************************************
//         Sessions/errors handling

session_start();

define("ERROR_BAD_REQUEST", 400);
define("ERROR_UNATHORIZED", 401);
define("ERROR_FORBIDDEN",   403);
define("ERROR_NO_LESSON",   406); 


function send_error($type, $message=''){
  switch($type){
    case ERROR_BAD_REQUEST:
      header("HTTP/1.0 400 Bad Rgit equest"); 
      break;
    case ERROR_UNATHORIZED:
      header("HTTP/1.0 401 Unathorized"); 
      break;
    case ERROR_FORBIDDEN:
      header("HTTP/1.0 403 Forbidden");
      break;
    case ERROR_NO_LESSON:
      header("HTTP/1.0 406 Not Acceptable");
      break;
    default:
      header("HTTP/1.0 456 Unrecoverable Error");
  }
  die(json_encode($message));
}

$user_id = null;

foreach($_SESSION as $key=>$val)
  if(strstr($key, '__id') !== false && is_numeric($val)){
    $user_id = (int)$val;
    break;
  }

if(!$user_id)   // No user - send 401
  send_error(ERROR_UNATHORIZED);
elseif( !isset($_SERVER['HTTP_X_REQUESTED_WITH']) ||
    $_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest' )
  send_error(ERROR_BAD_REQUEST);

// Requiring module classes

define('PING_DIRECTORY', 'protected/sync/');

require_once('protected/config/static/mysql_connect.php');
require_once(PING_DIRECTORY.'mysql_query.php');

$module_list = array(
  "navigation", 
  "chat", 
  "tracking"
);

require_once(PING_DIRECTORY.'SyncModuleInterface.php');
require_once(PING_DIRECTORY.'BaseSyncModule.php');

foreach($module_list as $module)
  require_once(PING_DIRECTORY.ucfirst($module). "SyncModule.php");


// Get sender_id and target_id

function getPartnerId($user_id){
  $result = _mysql('select role from user where id=?', $user_id);
  $user = mysql_fetch_array($result);
  $isTeacher = $user['role']=='teacher';
  $result = _mysql('select * from lesson_history
    where '.($isTeacher?'teacher_id':'student_id').'=? and status in (1,2,3)
    order by date,start_time
    limit 1', $user_id);  
  if($result){
    $lesson = mysql_fetch_array($result);
    $isStarted = $lesson['date'].' '.$lesson['start_time'] <= date("Y-m-d H:i:s", time()+5*60);
    $isFinished = $lesson['date'].' '.$lesson['start_time'] < date("Y-m-d H:i:s", time()-60*60);
    if($isStarted && !$isFinished)
      return $isTeacher?$lesson['student_id']:$lesson['teacher_id'];
  }
  return false;
}

$sender_id = $user_id;
$target_id = getPartnerId($user_id);

if(!$target_id)
  send_error('No lesson');

  // Parse data
$json = ( isset($_POST["json"]) ?
  json_decode($_POST["json"])   :
  null );

  // No data - no output
if($json == null || !isset($json->m) || !isset($json->g) )
  send_error(ERROR_BAD_REQUEST);




//*******************************************************
//      Dealing with data obtained from Client

$received_messages = $json->m;
$global_info = $json->g;
$log = array();

// delete all messages with keys as in $global_info->r

// add received messages to db
foreach($received_messages as $message){
  $module = $message->m;
    // $class_name = ucfirst($module)."SyncModule";
  $data = $message->d;
 
  // if($message->key != null)
  //   array_push($messages_to_send, array(
  //     "m" => "delivery",
  //     "d" => array(
  //       "status"=>"acepted",
  //       "key"=>$message->key
  //     )
  //   ));
  //array_push($log, $module);

  if(in_array($module, $module_list)){
    $class_name = ucfirst($module)."SyncModule";
    $module_inst = new $class_name;
    $ans = $module_inst->handleMessage($sender_id, $target_id, $data, $message->key);
    if(!$ans)
      $ans = mysql_error();
    array_push($log, array($module => $ans) );
  }    
}


//********************************************************
//           Generate new messages to save

$messages_to_send = Array();

// generate new packet number
$packet_number =  rand(0, 1e9);

$result = _mysql('select * from sync_messages
    where user_id=? and (status=0 or (status=1 and send_time<?) )
    order by created',
  $sender_id, time()-10);

_mysql('update sync_messages set status=1, send_time=?, `key`=?
    where user_id=? and (status=0 or (status=1 and send_time<?) )
    order by created',
  time(), $packet_number, $sender_id, time()-10);

while($message = mysql_fetch_array($result))
  array_push($messages_to_send, array(
    "m"   => $message['sync_module'],
    "d"   => json_decode($message['data'])
  ));

  // Send new messages
echo json_encode(array(
  'm' => $messages_to_send, 
  'g' => array(
    'n' => $packet_number
  ),
  'l' => $log
));
?>