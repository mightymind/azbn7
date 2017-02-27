<?
/*
основной обработчик API
*/

$type = $this->Azbn7->mdl('Req')->_post('type');

if($_SESSION[$type]['id']) {
	
	$entity = $_SESSION[$type];
	
	unset($entity['pass']);
	
	$param['response']['entity'] = $_SESSION[$type];
	
} else {
	
	$param['response']['entity'] = new stdClass();
	
}
