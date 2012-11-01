<?

interface SyncModuleInterface
{
    public function handleMessage($sender_id, $target_id, $message_data, $message_key);
    public function moduleName();
}

?>