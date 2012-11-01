<?php
class AuxWebUser extends CWebUser {
	private $_model;

	public function init(){
		$conf = Yii::app()->session->cookieParams;
		$this->identityCookie = array(
			'path' => $conf['path'],
			'domain' => $conf['domain'],
		);
		parent::init();
		$this->loadUser(Yii::app()->user->id);
	}
	
	protected function loadUser($id=null){
		if($this->_model===null)
			if($id!==null)
				$this->_model=User::model()->findByPk($id);
		return $this->_model;
	}
	
	public function checkAccess($operation, $params=array()){
		if(empty($this->id))
            return false;// Not identified => no rights
        if($this->role === 'admin')
  			return true;// admin role has access to everything
        return ($operation === $this->role);// allow access if the operation request is the current user's role
    }
	
	public function __get($name){
		if($name!='name' && parent::__isset($name))
			return parent::__get($name);
		elseif($this->_model !== null)
			if($this->_model->hasAttribute($name))
				return $this->_model[$name];
		return null;
	}
  
  public function extraInfo(){
    if($this->_model->role == 'teacher'){
      $data = Teacher::model()->findByPk($this->_model->id);
      if($data == null){
        $data = new Teacher;
        $data->user_id = $this->_model->id;
        $data->save();
      }
    }else{
      $data = Student::model()->findByPk($this->_model->id);
      if($data == null){
        $data = new Student;
        $data->user_id = $this->_model->id;
        $data->save();
      }
    }
    return $data;
  }
}
?>