<?php

class SiteController extends BaseController
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',
				'users'=>array('*'),
			),
		);
	}	
/*
	//
	public function actionCss($ids){
		header('Content-Type: text/css');
		echo $this->mergeResources('css', $ids);
	}
	
	//
	public function actionJs($ids){
		header('Content-Type: application/javascript');
		echo $this->mergeResources('js', $ids);
	}
	
	//
	protected function mergeResources($type, $ids){
		$idArray = explode('_', $ids);
		array_shift($idArray);
		$deps = BlockDepend::model()->findAllByPk($idArray);
		$data = '';
		
		switch($type){
			case 'css':$pre_name = 'style';break;
			case 'js':$pre_name = 'script';break;
		}
		
		foreach($deps as $dep){
			if($dep->location == 2)
				$link = BlockExternal::model()->findByPk($dep->link)->link;//такого не должно быть (external подключаются отдельно)
			else
				$link = dirname(Yii::app()->basePath).'/protected/views/'.$dep->link;

			$cont = file_get_contents($link);
			$data .= "\r\n".$cont;
		}
		
		//тут можно добавить минимизацию $data
		
		if(RESOURCE_CACHE)
			file_put_contents(dirname(Yii::app()->basePath).'/'.$type.'/'.$pre_name.$ids.'.'.$type, $data);
		
		return $data;
	}
*/
	public function actionOrder(){
		$err = array();
		$identity = new UloginUserIdentity();
		
		if($_POST['name'] == '')
			$err['name'] = 'Укажите своё имя.';
		if($_POST['email'] == '')
			$err['email'] = 'Укажите E-mail.';
		elseif(!$identity->checkemail($_POST['email']))
			$err['email'] = 'E-mail некорректен.';
		if($_POST['phone'] == '')
			$err['phone'] = 'Укажите телефон.';
		
		if($err == array()){
			$pass = $this->generatePass();
			if($id = $identity->register($_POST['email'], $pass)){
				$this->mailRegister($_POST['email'],$_POST['name'],$pass);
				
				$row = new Order;
				$row->name = $_POST['name'];
				$row->email = $_POST['email'];
				$row->phone = $_POST['phone'];
				$row->datetime = $this->datetime();
				$row->save();
				
				$user = User::model()->findByPk($id);
				$user->name = $row->name;
				$user->mobile = $row->phone;
				$user->save();
			}elseif($identity->err == 3){
				$err['email'] = 'E-mail уже занят.';
			}elseif($identity->err == 4){
				$err['email'] = 'E-mail некорректен.';
			}	
		}
		
		if($err == array()){
			echo CJSON::encode(array(
				'result'=>'success',
				'msg'=>'Ваша заявка принята.'
			));
			$this->sendSMS('9151196732','SkyEng: заявка на пробный урок.');
			$this->sendSMS('9645875892','SkyEng: заявка на пробный урок.');
		}else{
			$errors_msg = '';
			foreach($err as $e)
				$errors_msg .= $e.'<br />';
			echo CJSON::encode(array(
				'result'=>'fail',
				'msg'=>$errors_msg,
				'name'=>$_POST['name'],
				'email'=>$_POST['email'],
				'phone'=>$_POST['phone'],
			));
		}
	}

	public function actionIndex(){
		if(Yii::app()->user->isGuest){
			Yii::app()->user->returnUrl = '';
			$this->layout = 'external';
			$this->page('index');
		}else
			$this->redirect(Yii::app()->request->hostInfo.'/beforeLesson');
	}
	
	public function actionStatic($page_name){
		// Массив страничек, которые видно из неавторизованной зоны с соответствующим лэйаутом
		$externalStaticPagesArray = array('how-to-pay','agreement','contacts','for-teachers','about');
		
		// Массив страничек, которые видно из авторизованной зоны с соответствующим лэйаутом
		$internalStaticPagesArray = array();

		if(		in_array($page_name,$externalStaticPagesArray)){
			
			$this->layout = 'external';
			$this->page('static/'.$page_name);
			
		}elseif(in_array($page_name,$internalStaticPagesArray)){
			
			$this->layout = 'internal';
			$this->page('static/'.$page_name);
			
		}else
			throw new CHttpException(404, 'Not Found');
	}

	public function actionError(){
		$this->layout='main';//сделать свой для error
		if($error = Yii::app()->errorHandler->error)
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', array('error'=>$error));
	}
}