<?php

class AdminController extends BaseController
{
	public $layout='admin';
	
	public function filters()
	{
		return array(
			'accessControl',
			'ajaxOnly + add, renew, blockNewView,blockDepDelete,blockDepAdd'
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array(
					'todo','todoAdd','todoRenew',
					'block','scenario','blockNewView','blockDepDelete','blockDepAdd',
					'orders',
					'updateVersion'
				),
				'roles'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}	
	
	
	public function actionTodo(){
		$arr = Plan::model()->findAll(array('order'=>'status, id desc'));
		$this->render('todo', array('data'=>$arr));
	}
	
	public function actionTodoAdd(){
		$new = new Plan;
		$new->text = $_POST['text'];
		$new->user = $_POST['user'];
		$new->save();
		$arr = Plan::model()->findAll(array('order'=>'status, id desc'));
		echo $this->renderPartial('_plan_table', array('data'=>$arr));
	}
	
	public function actionTodoRenew(){
		$row = Plan::model()->findByPk($_POST['id']);
		$row->status++;
		$row->save();
		$arr = Plan::model()->findAll(array('order'=>'status, id desc'));
		echo $this->renderPartial('_plan_table', array('data'=>$arr));
	}
	
	
	public function actionBlock(){
		$data = BlockView::model()->findAll(array(
			'select'=>'distinct block',
			'order'=>'block'
		));
		foreach($data as $row){
			$deps = BlockView::model()->findAll(array(
				'condition'=>'block=:BL',
				'params'=>array(':BL'=>$row->block),
				'order'=>'scenario',
			));
			$scen[$row->block] = $deps;
		}
		$this->render('block',array('blocks'=>$data,'scenarios'=>$scen));
	}
	
	public function actionScenario($id){
		$css = BlockDepend::model()->findAll(array(
			'condition'=>'view_id=:ID and type=\'css\'',
			'params'=>array(':ID'=>$id),
			'order'=>'location desc,link',
		));
		$js = BlockDepend::model()->findAll(array(
			'condition'=>'view_id=:ID and type=\'js\'',
			'params'=>array(':ID'=>$id),
			'order'=>'location desc,link',
		));
		$html = BlockView::model()->findByPk($id)->view;
		
		$view = BlockView::model()->findByPk($id);
		
		$this->render('scenario',array(
			'view'=>$view,
			'html'=>$html,
			'css'=>$css,
			'js'=>$js,
		));
	}
	
	public function actionBlockNewView(){
		$view = BlockView::model()->findByPk($_POST['id']);
		$view->view = $_POST['new'];
		$view->save();
		echo $view->view;
	}
	
	public function actionBlockDepDelete(){
		$dep = BlockDepend::model()->findByPk($_POST['id']);
		$dep->delete();
		echo $_POST['id'];
	}
	
	public function actionBlockDepAdd(){
		$dep = new BlockDepend;
		$dep->view_id = $_POST['view_id'];
		$dep->link = $_POST['link'];
		$dep->location = $_POST['location'];
		$dep->type = $_POST['type'];
		$dep->save();
		$this->renderPartial('_row_depend',array('dep'=>$dep));
	}
	
	
	public function actionOrders(){
		$arr = Order::model()->findAll(array('order'=>'id desc'));
		$this->render('orders', array('data'=>$arr));
	}
	
	public function actionUpdateVersion($doit=0){
		$data = array();
		$result = '';
		if($doit==1){
			$data[] = 'user: id='.Yii::app()->user->id;
			$hist = new VersionHistory;
			$hist->start = $this->datetime();
			exec('
cd ../backup
tar -czvf production.'.$this->datetimeNoSpace().'.tar.gz ../production/
mysqldump --opt -ufundaypr_skyeng -pxW17nzOaCOk7G3NPy fundaypr_skyeng_production > skyeng_production.'.$this->datetimeNoSpace().'.sql
mysqldump --opt -ufundaypr_skyeng -pxW17nzOaCOk7G3NPy fundaypr_skyeng_devel > skyeng-d.now.sql

cd ..
mv production/index.php index.php
mv production/robots.txt robots.txt
cp backup/block.php production/index.php
mv production/protected/config/static .

mysql -ufundaypr_skyeng -pxW17nzOaCOk7G3NPy fundaypr_skyeng_production < backup/skyeng-d.now.sql
rm backup/skyeng-d.now.sql

rm -rf production
cp -r devel production
rm -rf production/protected/config/static
mv static/ production/protected/config
mv robots.txt production/robots.txt
mv index.php production/index.php
				', $data, $result);	
			$data[] = '--end--';
			$hist->data = implode("\r\n", $data);
			$hist->finish = $this->datetime();
			$hist->save();
			$result .= '<br />ok';
		}
		$this->render('updateVersion', array('result'=>$result, 'data'=>$data));
	}
}