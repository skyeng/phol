<?php
class UloginUserIdentity extends CUserIdentity{
    public $id;
    public $isAuthenticated = false;
    public $states = array();
	
	public $err=0;//для проброса ошибок

    public function __construct(){
    }

    public function salten($password, $salt='salty salt and shitty shit'){
        return md5(md5($password).$salt); 
    }

    public function checkemail($email){
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }
	
	//аут. при входе через чужие аккаунты (uLogin)
    public function authenticate($uloginModel = null){
        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $uloginModel->identity,
			':network' => $uloginModel->network
        );
        $user = User::model()->find($criteria);

        if(null !== $user){
            $this->id = $user->id;
        }else{
            $user = new User();
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->email = $uloginModel->email;
            $user->full_name = $uloginModel->full_name;
            $user->save();

            $this->id = $user->id;
        }
        $this->isAuthenticated = true;
        return true;
    }
	
	//аут. при обычном входе с паролем
    public function authenticate_with_password($identity, $password){
        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $identity,
			':network' => 'skyeng'
        );
        $user = User::model()->find($criteria);
		
        if(null !== $user && $user->password == $this->salten($password)){
            $this->id = $user->id;
			
			$this->isAuthenticated = true;
			return true;
        }else
            return false;
    }
	
	//регистрация + сразу аут.
    public function register($identity, $password){
        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $identity,
			':network' => 'skyeng'
        );
        $user = User::model()->find($criteria);
		
        if(null !== $user){
			$this->err = 3;
            return false;
		}elseif(!$this->checkemail($identity)){
			$this->err = 4;
            return false;
		}
		
        $user = new User();
        $user->identity = $identity;
        $user->network = 'skyeng';
        $user->email = $identity;
        $user->password = $this->salten($password);
        $user->save();
		
        $this->id = $user->id;

        $this->isAuthenticated = true;
        return $user->id;
    }

    public function getId(){
        return $this->id;
    }

    public function getIsAuthenticated(){
        return $this->isAuthenticated;
    }

    public function getPersistentStates(){
        return $this->states;
    }	
}