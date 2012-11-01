<?
class BaseSyncModule implements SyncModuleInterface{

  public function moduleName(){
    return get_class($this);
  }

  public function handleMessage($sender_id, $target_id, $message_data, $message_key = null){
    echo get_class($this);
    return _mysql('insert into sync_messages (user_id,sync_module,data,`key`,expired) values (?,?,?,?,?)',
      $target_id, "", json_encode($message_data), $message_key, $expired);
  }

  protected function saveMessage($target_id, $module, $message_data, $message_key = null, $expired = null)
  {
    
  }
}
?>