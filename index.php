<?
// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';



// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
ini_set('display_errors',1);

require_once($yii);
$config=dirname(__FILE__).'/protected/config/main.php';

if(array_shift(explode('.',$_SERVER['HTTP_HOST'])) == 'en')
	define('LANG', 'en');
else
	define('LANG', 'ru');
define('RESOURCE_CACHE', false);

Yii::createWebApplication($config)->run();
?>