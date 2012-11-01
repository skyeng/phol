<?
require_once('smsimple.class.php');

class BaseController extends CController{
	public $layout='main';
	
	//остались от yii
	public $menu=array();
	public $breadcrumbs=array();
	
	public $blocks=array();
	public $need_blocks=array();
	public $have_blocks=array();
	
	public $styles=array();
	public $ie_styles=array();
	public $scripts=array();
	
	public $T=array();
	
	
	
	//дата для записи в базу
	public function date($ts=null){
		return $ts?date('Y-m-d', $ts):date('Y-m-d');
	}
	
	//время для записи в базу
	public function time($ts=null){
		return $ts?date('H:i:s', $ts):date('H:i:s');
	}
	
	//датавремя для записи в базу
	public function datetime($ts=null){
		return $ts?date('Y-m-d H:i:s', $ts):date('Y-m-d H:i:s');
	}
	
	//возвращает рендер заданного вида (путь от корня views/)
	//для вывода видов из других контроллеров
	public function renderOther($view, $params=array(), $return=false){
		$abs_view = Yii::app()->basePath.'/views/'.$view.'.php';
		return $this->renderFile($abs_view, $params, $return);
	}
	
	//подключит, если уже не подключен
	public function first_block($path, $params=array(), $return=false){
		if($this->isExist($path))
			return false;
		
		$this->inverse();
		$return = $this->block($path, $params, $return);
		$this->inverse();
		
		return $return;
	}
	
	//для добавления блоков на первое место
	protected function inverse(){
		$this->blocks = array_reverse($this->blocks);
		$this->styles = array_reverse($this->styles);
		$this->scripts = array_reverse($this->scripts);
	}
	
	//подключит, если уже не подключен
	public function single_block($path, $params=array(), $return=false){
		if($this->isExist($path))
			return false;
		
		return $this->block($path, $params, $return);
	}
	
	public function need($path, $params=array()){
		if($this->isExist($path) || $this->isNeed($path))
			return true;
		
		if(Yii::app()->request->isAjaxRequest && $this->isHave($path))
			return true;
		
		$this->need_blocks[] = array($path, $params);
		return false;
	}
	
	public function ajax_block($path, $params=array(), $return=false){
		$block = $this->block($path, $params, true);
		list($css, $js, $ie_css) = $this->afterRender($path, $block);
		$data = CJSON::encode(array(
			'css'=>$css,
			'ie_css'=>$ie_css,
			'js'=>$js,
			'page'=>$block,
		));
		
		if($return)
			return $data;
		
		echo $data;
	}
	
	//вставляет рендер блока и прописывает все зависимости
	public function block($path, $params=array(), $return=false){
		//echo 'block: '.$path.'{<br />';
		
		$this->blocks[] = $path;
		
		$dir = dirname(Yii::app()->basePath).'/protected/views/blocks';
		$dir = str_replace('\\', '/', $dir); 
		$parts = explode('/', $path);
		$dir .= '/'.$parts[0];
		$views = array();
		
		//обрабатываем сам блок и вложенный модификатор (может быть модификатор модификатора)
		for($i=0; $parts[$i]; $dir .= '/'.$parts[++$i]){
			$view = $this->processDir($dir);
			if($view)
				$views[] = $view;
			if(file_exists($dir.'/_messages/'.LANG.'.php'))
				$this->T = CMap::mergeArray($this->T, require($dir.'/_messages/'.LANG.'.php'));
		}
		
		//поочереди вставляет все модификаторы в вид
		$pre_view = '';
		foreach(array_reverse($views) as $key=>$view)
			$pre_view = $this->renderFile($view, CMap::mergeArray($params, array('modifier'=>$pre_view)), true);
		
		if($return){
			//echo 'block: '.$path.'}<br />';
			return $pre_view;
		}
			
		echo $pre_view;
		
		//echo 'block: '.$path.'}<br />';
		return true;
	}
	
	//отрендерить страницу
	//beforeRender() вызывается до рендера основного вида, но ПОСЛЕ рендера модификаторов
	public function page($path, $params=array()){
		//echo 'page: '.$path.'{<br />';
		
		$dir = dirname(Yii::app()->basePath).'/protected/views/pages';
		$dir = str_replace('\\', '/', $dir); 
		$parts = explode('/', $path);
		$dir .= '/'.$parts[0];
		$views = array();
		
		//обрабатываем сам блок и вложенный модификатор (может быть модификатор модификатора)
		for($i=0; $parts[$i]; $dir .= '/'.$parts[++$i]){
			$view = $this->processDir($dir);
			if($view)
				$views[] = $view;
			if(file_exists($dir.'/_messages/'.LANG.'.php'))
				$this->T = CMap::mergeArray($this->T, require($dir.'/_messages/'.LANG.'.php'));
		}
	
		//поочереди вставляет все модификаторы в вид
		$pre_view = '';
		$main_view = array_shift($views);
		foreach(array_reverse($views) as $key=>$view)
			$pre_view = $this->renderFile($view, CMap::mergeArray($params, array('modifier'=>$pre_view)), true);

		// Multi-platform hack
		//$dirname_escaped = str_replace('\\', '\\\\', dirname(Yii::app()->basePath)); 
		$dirname_escaped = str_replace('\\', '/', dirname(Yii::app()->basePath)); 
		
		preg_match('#'.$dirname_escaped.'/protected/views/(.+)\.php#', $main_view, $match);

		$this->render('//'.$match[1], CMap::mergeArray($params, array('modifier'=>$pre_view)));
		
		//echo 'page: '.$path.'}<br />';
		return true;
	}
	
	//если надо что-то рендерить - возвращает путь к виду
	protected function processDir($dir){
		if(is_dir($dir))
			$cur_dir = opendir($dir);
		if(!$cur_dir)
			throw new CHttpException(500, '[bad dir: '.$dir.']');

		$view = null;
		while($file = readdir($cur_dir))
			if(($file != ".") && ($file != ".."))
				if(!is_dir($dir.'/'.$file)){
					$result = $this->processFile($dir.'/'.$file);
					if($result)
						$view = $result;					
				}else{
					//$this->processDir($dir.'/'.$file);//рекурсивно дальше - не нужно
				}
		closedir($cur_dir);
		return $view;
	}
	
	//если надо что-то рендерить - возвращает путь к виду
	protected function processFile($path){
		$parts = array_reverse(explode('/', $path));
		$name_parts = array_reverse(explode('.', $parts[0]));
		if($name_parts[1]){
			$ext = $name_parts[0];
			if($name_parts[1] == 'ie')
				$ext = $name_parts[1].'.'.$name_parts[0];
		}else
			$ext = '';
		
		switch($ext){
			case 'php':return $path;
			case 'css':$this->styles[] = $path; break;
			case 'ie.css':$this->ie_styles[] = $path; break;
			case 'js' :$this->scripts[] = $path; break;
		}
		return null;
	}
	
	//подключен ли уже данный блок
	private function isExist($path){
		foreach($this->blocks as $one)
			if($one == $path)
				return true;
		return false;
	}
	
	private function isNeed($path){
		foreach($this->need_blocks as $one)
			if($one[0] == $path)
				return true;
		return false;
	}
	
	private function isHave($path){
		foreach($this->have_blocks as $one)
			if($one == $path)
				return true;
		return false;
	}
	
	//подключение основных зависимостей страницы
	protected function beforeRender($view){
		return true;
	}
	
	//подгружает все прописанные зависимости
	protected function afterRender($view, &$output){
		foreach(array_reverse($this->need_blocks) as $block)
			$this->first_block($block[0], $block[1], true);
		
		$output = preg_replace('/<!--HAVE_BLOCKS-->/', '<script type="text/javascript">var have_blocks = '.CJSON::encode($this->blocks).';</script>', $output);
			
		//echo 'blocks:<br /><pre>';print_r($this->blocks);echo '</pre>';
		//echo 'need:<br /><pre>';print_r($this->need_blocks);echo '</pre>';
		//echo 'css:<br /><pre>';print_r($this->styles);echo '</pre>';
		//echo 'js:<br /><pre>';print_r($this->scripts);echo '</pre>';
		
		$name_css = $this->getResourcesFilename('css', $this->styles);
		$name_abs = dirname(Yii::app()->basePath).$name_css;
		if(!RESOURCE_CACHE || !file_exists($name_abs))
			$data_css = $this->mergeResources('css', $this->styles);
		elseif(Yii::app()->request->isAjaxRequest)
			$data_css = file_get_contents($name_abs);
		
		//стили для IE
		$name_ie_css = $this->getResourcesFilename('css', $this->ie_styles);
		$name_ie_abs = dirname(Yii::app()->basePath).$name_ie_css;
		if(!RESOURCE_CACHE || !file_exists($name_abs))
			$data_ie_css = $this->mergeResources('css', $this->ie_styles);
		elseif(Yii::app()->request->isAjaxRequest)
			$data_ie_css = file_get_contents($name_abs);
		
		$name_js = $this->getResourcesFilename('js', $this->scripts);
		$name_abs = dirname(Yii::app()->basePath).$name_js;
		if(!RESOURCE_CACHE || !file_exists($name_abs))
			$data_js = $this->mergeResources('js', $this->scripts);
		elseif(Yii::app()->request->isAjaxRequest)
			$data_js = file_get_contents($name_abs);
		
		if(Yii::app()->request->isAjaxRequest)
			return array($data_css, $data_js, $data_ie_css);
			
		Yii::app()->getClientScript()->registerCssFile($name_css);
		$output = preg_replace('#(</head>)#', '<!--[if IE]>
<link rel="stylesheet" type="text/css" href="'.$name_ie_css.'" />
<![endif]-->
$1', $output);
		Yii::app()->getClientScript()->registerScriptFile($name_js);		
		return true;
	}
	
	protected function getResourcesFilename($type, $paths){		
		$name = '';
		foreach($paths as $path)
			$name .= ':'.$path;
		return '/'.$type.'/'.md5($name).'.'.$type;
	}
	
	protected function mergeResources($type, $paths){
		$name = $data = '';
		foreach($paths as $path){
			$name .= ':'.$path;
			$cont = file_get_contents($path);
			$data .= "\r\n".$cont;
		}
		
		//тут можно добавить минимизацию $data
		//switch($type){}
		
		if(RESOURCE_CACHE || !Yii::app()->request->isAjaxRequest){
			$name = '/'.$type.'/'.md5($name).'.'.$type;
			file_put_contents(dirname(Yii::app()->basePath).$name, $data);
		}

		if(Yii::app()->request->isAjaxRequest)
			return $data;
		else
			return null;
	}
	
	protected function mailRegister($to, $name, $pass){
		$message = 'Здравствуйте, '.$name.'!

Спасибо, что оставили заявку на пробный урок английского языка в компании SkyEng.
В ближайшее время наш оператор непременно свяжется с вами и предложит выбрать удобное время для первого занятия.

Вы можете войти в систему на сайте http://skyeng.ru, используя следующие учетные данные:
Логин: '.$to.'
Пароль: '.$pass.'

Ждем Вас на skyeng.ru!';
		mail($to, 'Регистрация на SkyEng', $message, "From: SkyEng <register@skyeng.ru>");
	}
	
	protected function generatePass($length=8){
		$symb =array('a','b','c','d','e','f',  
					 'g','h','i','j','k','l',  
					 'm','n','o','p','q','r',
					 's','t','u','v','w','x',
					 'y','z','1','2','3','4',
					 '5','6','7','8','9','0');
		$pass = '';
		for($i=0; $i<$length; $i++)
			$pass .= $symb[rand(0, count($symb) - 1)];
		return $pass;
	}
	
	protected function sendSMS($phone, $message){
		$sms = new SMSimple(array(
			'url'      => 'http://api.smsimple.ru',
			'username' => 'fundaypro', 
			'password' => 'Surface123', 
		));
		try{
			$sms->connect();
			//print_r($sms->origins());
			$origin_id = 53957;
			$message_id = $sms->send($origin_id, $phone, $message);
		}
		catch(SMSimpleException $e){
			//print $e->getMessage();
			error_log('SMSimpleException: '.$e->getMessage(), 0);
		}
	}
}
?>