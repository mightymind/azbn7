<?
// CMS Azbn7

// подключение конфига
//$host = explode(':',$_SERVER['HTTP_HOST']);
//require_once('sites/config/'.strtolower($host[0]).'.config.php');

require_once('sites/config/localhost.config.php');

//var_dump($CONFIG);die();

// запуск главного класса фреймворка
require_once($CONFIG['path']['azbn7'].'/azbn7.class.php');

$Azbn7 = new \azbn7\Azbn7($CONFIG);
unset($CONFIG);

session_start();

$Azbn7
	->load(array(
		'dir' => 'azbn7',
		'mdl' => 'Tester',
		'uid' => 'Tester',
		'param' => array()
	))
	->load(array(
		'dir' => 'azbn7',
		'mdl' => 'Storage_MySQL',
		'uid' => 'DB',
		'param' => array()
	))
	->load(array(
		'dir' => 'azbn7',
		'mdl' => 'Storage_SQLite',
		'uid' => 'SQLite',
		'param' => array()
	))
	->load(array(
		'dir' => 'azbn7',
		'mdl' => 'Ext',
		'uid' => 'Ext',
		'param' => array()
	))
	->load(array(
		'dir' => 'azbn7',
		'mdl' => 'Req',
		'uid' => 'Req',
		'param' => array()
	))
	->load(array(
		'dir' => 'app',
		'mdl' => 'Session',
		'uid' => 'Session',
		'param' => array()
	))
	->load(array(
		'dir' => 'app',
		'mdl' => 'Site',
		'uid' => 'Site',
		'param' => array()
	))
	->load(array(
		'dir' => 'app',
		'mdl' => 'Entity',
		'uid' => 'Entity',
		'param' => array()
	))
	->load(array(
		'dir' => 'app',
		'mdl' => 'Viewer',
		'uid' => 'Viewer',
		'param' => array()
	))
;



$Azbn7
	->mdl('Ext')
		->loadExts($EXT__ON_LOAD)
;


/* ---------- ext__event ---------- */
$Azbn7
	->mdl('Ext')
		->event($Azbn7->mdl('DB')->event_prefix . '.connect.before')
;
/* --------- /ext__event ---------- */


$Azbn7
	->mdl('DB')
		->connect($Azbn7->config['mysql'][0])
;

/* ---------- ext__event ---------- */
$Azbn7
	->mdl('Ext')
		->event($Azbn7->mdl('DB')->event_prefix . '.connect.after')
;
/* --------- /ext__event ---------- */



$Azbn7
	->mdl('Req')
		->parseURL()
;


/* ---------- ext__event ---------- */
$Azbn7
	->mdl('Ext')
		->event($Azbn7->mdl('Req')->event_prefix . '.parseURL.after')
;
/* --------- /ext__event ---------- */


$Azbn7
	->load(array(
		'dir' => 'app',
		'mdl' => 'AppRouter',
		'uid' => 'AppRouter',
		'param' => array()
	))
	->mdl('AppRouter')
		->route($Azbn7->data['mdl']['Req']['req_url'])
;


/* ---------- ext__event ---------- */
$Azbn7
	->mdl('Ext')
		->event($Azbn7->mdl('Req')->event_prefix . '.request.after')
;
/* --------- /ext__event ---------- */



/*
echo "\n";

$created_at = 0;
$memory = 0;

if(count($Azbn7->__events)) {
	foreach($Azbn7->__events as $i => $ev) {
		if($i == 0) {
			$created_at = $ev['created_at'];
			$memory = $ev['memory'];
		}
		echo ($ev['created_at'] - $created_at) . ': ' . $ev['title'] . '(' . ($ev['memory'] - $memory) . ')' . "\n";
		$created_at = $ev['created_at'];
		$memory = $ev['memory'];
	}
}
*/

//var_dump($Azbn7->__events);

//print_r(PDO::getAvailableDrivers());
