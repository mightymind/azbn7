<?
// автор @mightymind
// настройки движка и сайта

//ignore_user_abort(true);
@error_reporting(E_ALL | E_NOTICE | E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_CORE_WARNING);
//@error_reporting(0); // отключение вывода ошибок и предупреждений
@set_time_limit(0); // отключение лимита на время работы скрипта
@ini_set('register_globals', false); // отключение register_globals
@ini_set('memory_limit', '32M'); // определение лимита для выделения памяти
@date_default_timezone_set('Europe/Minsk');

$app_uid = 'azbn7';

$CONFIG = array(
	'debug' 			=> 1,
	'app_uid'				=> $app_uid,
	'charset'			=> 'UTF-8',
	'path'				=> array(
							'cache' => 'cache/'.$app_uid,
							'backup' => 'backup/'.$app_uid,
							'upload' => 'upload/'.$app_uid,
							'system' => 'system',
							'azbn7' => 'system/azbn7',
							'app' => 'sites/apps/'.$app_uid,
							//'tpl' => 'sites/apps/'.$app_uid,
	),
	'mysql' 			=> array(
						0 => array(
							'host' => 'localhost',
							'user' => $app_uid,
							'pass' => $app_uid,
							'db' => $app_uid,
							'charset' => 'UTF8',
							'prefix' => $app_uid,
							'max_value' => array(
								'int' => '2147483647',
								'bigint' => '9223372036854775807',
							),
							'connect_settings' => array(
								PDO::ATTR_PERSISTENT => true,
							),
							't' => array(
								'sysopt' => $app_uid . '_sysopt',
								'sysopt_data' => $app_uid . '_sysopt_data',
								'alias' => $app_uid . '_alias',
								'log' => $app_uid . '_log',
								
								
								//'cache' => $app_uid . '_cache',
								//'log' => $app_uid . '_log',
								//'search' => $app_uid . '_search',
								//'option' => $app_uid . '_option',
								
								//'user' => $app_uid . '_user',
								//'profile' => $app_uid . '_profile',
								//'upload' => $app_uid . '_upload',
								//'file' => $app_uid . '_file',
								//'img' => $app_uid . '_img',
								
								'entity' => $app_uid . '_entity',
								'entity_type' => $app_uid . '_entity_type',
								'entity_data' => $app_uid . '_entity_data',
								'entity_cat' => $app_uid . '_entity_cat',
							),
						),
	),
	'sqlite'			=> array(
						0 => array(
							'file' => 'sites/apps/'.$app_uid.'/data/sqlite/default.db',
						),
	),
);