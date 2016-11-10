<?
// CMS Azbn7

// подключение конфига
//$host = explode(':',$_SERVER['HTTP_HOST']);
//require_once('sites/config/'.strtolower($host[0]).'.config.php');

require_once('sites/config/localhost.config.php');

//var_dump($CONFIG);die();

// запуск главного класса фреймворка
require_once($CONFIG['path']['azbn7'].'/azbn7.class.php');
$Azbn7 = new Azbn7($CONFIG);
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
		'mdl' => 'Req',
		'uid' => 'Req',
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
	->mdl('DB')
		->connect($Azbn7->config['mysql'][0])
;

$Azbn7
	->mdl('Req')
		->parseURL()
;

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

/*
$Azbn7
	->mdl('Tester')
		->test('World')
;

$param = array('123');

$Azbn7
	->run('azbn7', 'tester', $param)
;
*/

/*
$Azbn7
	->load(array(
		'dir' => 'app',
		'mdl' => 'Viewer',
		'uid' => 'Viewer',
		'param' => array()
	))
;
$Azbn7
	->mdl('Viewer')
		->tpl('default', array())
;
*/








/*
echo "\n";

echo $Azbn7
	->mdl('DB')
		->delete('test')
;

echo "\n";

echo $Azbn7
	->mdl('DB')
		->create('test', array(
			'created_at' => $Azbn7->created_at,
			'title' => 'запуск скрипта в момент ' . $Azbn7->created_at,
		));

echo "\n";

echo $Azbn7
	->mdl('DB')
		->update('test', array('title' => '123445677657567'), '1')
;

echo "\n";

var_dump($Azbn7->mdl('DB')->read('test'));

echo "\n";

var_dump($Azbn7->mdl('DB')->one('test', 'id > 0'));

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
