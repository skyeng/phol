<?php

require_once('lib/xmlrpc.inc');

class SMSimpleException extends Exception{}

class SMSimple
{
    protected $session_id = '';
    protected $username = '';
    protected $password = '';
    protected $encoding = 'UTF-8';
    protected $url = '';
    protected $xmlrpc = null;

    public function __construct($params=array()) {
        if (isset($params['username']))
            $this->username = $params['username'];
        if (isset($params['password']))
            $this->password = $params['password'];
        if (isset($params['url']))
            $this->url = $params['url'];

        global $xmlrpc_internalencoding, $xmlrpc_defencoding;
        $xmlrpc_internalencoding = $this->encoding;
        $xmlrpc_defencoding = $this->encoding;
        $this->xmlrpc = new xmlrpc_client($this->url);
        $this->xmlrpc->return_type = 'phpvals';
        $this->xmlrpc->request_charset_encoding = $this->encoding;
    }

    /**
     * Системный метод вызова XML-RPC функций API
     */
    protected function _doApiCall($method, $params=array()) {
        $response = $this->xmlrpc->send(new xmlrpcmsg('call', array(new xmlrpcval($method), php_xmlrpc_encode($params))));
        if ($response->faultCode())
            throw new SMSimpleException($response->faultString());
        $result = $response->value();
        if (isset($result['info']) && !empty($result['info']))
            throw new SMSimpleException($result['info']);
        if (isset($result['result']))
            return $result['result'];
        return false;
    }

    /**
     * Соединение с шлюзом SMSimple.ru
     */
    public function connect() {
        $res = $this->_doApiCall('pajm.user.auth', array(
            'username' => $this->username,
            'password' => $this->password,
        ));
        if (!$res)
            throw new SMSimpleException('Invalid API username or password');
        $this->session_id = $res['session_id'];
        return true;
    }

    /**
     * Отправка одиночного сообщения
     */
    public function send($origin_id, $phone, $message, $multiple = false) {
        $message_id = $this->_doApiCall('pajm.sms.send', array(
            'session_id' => $this->session_id,
            'origin_id'  => $origin_id,
            'phone'      => $phone,
            'message'    => $message,
            'multiple'   => $multiple,
        ));
        return $message_id;
    }

    /**
     * Проверка статуса доставки сообщения, отправленного с помощью метода send()
     */
    public function check_delivery($message_id) {
        $message_id = $this->_doApiCall('pajm.sms.get_delivery', array(
            'session_id' => $this->session_id,
            'sms_id'     => $message_id,
        ));
        return $message_id;
    }

    /**
     * Создание новой рассылки
     */
    public function addJob($params=array()) {
        $job_id = $this->_doApiCall('pajm.job.add', array(
            'session_id' => $this->session_id,
            'origin_id'  => $params['origin_id'],
            'groups'     => $params['groups_ids'],
            'title'      => $params['title'],
            'template'   => $params['message'],
            'start_date' => $params['start_date'],
            'start_time' => $params['start_time'],
            'stop_time'  => $params['stop_time'],
        ));
        return $job_id;
    }

    /**
     * Получение списка подписей
     */
    public function origins() {
        return $this->_doApiCall('pajm.origin.select', array(
            'session_id' => $this->session_id,
        ));
    }

    /**
     * Вставка нового контакта в существующую группу
     *      $params = array(
     *          'group_id' => 1,
     *          'phone'    => '7-926-111-22-33',
     *          'title'    => 'Василий Пупкин',
     *          'custom_1' => '',
     *          'custom_2' => '',
     *      );
     */
    public function addContactToGroup($params=array()) {
        return $this->_doApiCall('pajm.contact.add', array(
            'session_id' => $this->session_id,
            'group_id'   => $params['group_id'],
            'phone'      => $params['phone'],
            'title'      => $params['title'],
            'custom_1'   => $params['custom_1'],
            'custom_2'   => $params['custom_2'],
        ));
    }

    /**
     * Получение информации о профиле
     */
    public function get_profile() {
        return $this->_doApiCall('pajm.user.get', array(
            'session_id' => $this->session_id,
        ));
    }
    
    /**
     * Старт USSD сессии
     * $phone = 7-999-1234567
     * $optional = любые данные для дополнительной идентификации, сопровождают сессию до закрытия
     * $encoding = 'GSM-7' для меню на латинице или 'UCS2' для меню с русскими буквами
     */
    public function ussd_session_start($phone,$optional=null,$encoding='GSM-7') {
        return $this->_doApiCall('pajm.ussd.start_session', array(
            'session_id' => $this->session_id,
            'phone' => $phone,
            'optional' => $optional,
            'encoding' => $encoding,
        ));
    }   

    /**
     * Прерывание USSD сессии
     */
    public function ussd_session_abort($ussd_session_id) {
        return $this->_doApiCall('pajm.ussd.release_session', array(
            'session_id' => $this->session_id,
            'ussd_session_id' => $ussd_session_id,
        ));
    }   

}
