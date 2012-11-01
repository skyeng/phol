<?php
class LoginController extends BaseController{
    public function filters(){
        return array(
            'accessControl',
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('login','uLogin','register','logout'),
                'users'=>array('*'),
            ),
        );
    }

	public function actionLogin(){
        if(isset($_POST['email1']) && isset($_POST['pass1'])){
            $identity = new UloginUserIdentity();
            if($identity->authenticate_with_password($_POST['email1'], $_POST['pass1'])){
                //Yii::app()->user->login($identity,3600*24*7);
                Yii::app()->user->login($identity);
                //echo "true";
				$this->redirect( Yii::app()->user->returnUrl=='' ? 
                    (Yii::app()->request->hostInfo.'/') : Yii::app()->user->returnUrl );
            }else
				$this->redirect((Yii::app()->user->returnUrl==''?(Yii::app()->request->hostInfo.'/'):Yii::app()->user->returnUrl).'?err=1');
		}else{
            $this->redirect(Yii::app()->homeUrl, true);
        }
	}
	
	public function actionRegister(){
        if(isset($_POST['email2']) && isset($_POST['pass2'])){
            if(isset($_POST['agree']) && $_POST['agree']==1){
				$identity = new UloginUserIdentity();
				if($identity->register($_POST['email2'], $_POST['pass2'])){
					//Yii::app()->user->login($identity,3600*24*7);
					Yii::app()->user->login($identity);
					$this->redirect(Yii::app()->request->hostInfo.'/'.Yii::app()->user->returnUrl);
				}else
					$this->redirect(Yii::app()->request->hostInfo.'/'.Yii::app()->user->returnUrl.'?err='.$identity->err);
			}else
				$this->redirect(Yii::app()->request->hostInfo.'/'.Yii::app()->user->returnUrl.'?err=2');
		}else{
            $this->redirect(Yii::app()->homeUrl, true);
        }
	}
	
	public function actionULogin(){
        if(isset($_POST['token'])){
            $ulogin = new UloginModel();
            $ulogin->setAttributes($_POST);
            $ulogin->getAuthData();
            if($ulogin->validate() && $ulogin->login())
                $this->redirect(Yii::app()->request->hostInfo.'/'.Yii::app()->user->returnUrl);
            else
                $this->render('error');
        }else{
            $this->redirect(Yii::app()->homeUrl, true);
        }
    }

    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}