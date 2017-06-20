<?
/*
основной обработчик API
*/

$type_id = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_post('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$type_id}'");

$title = $this->Azbn7->mdl('Req')->_post('title');
$path = $this->Azbn7->mdl('Req')->_post('path');

if($path != '' && $this->Azbn7->mdl('Site')->is('user')) {
	
	$item = array(
		'type' => $type['uid'],
		'entity' => array(
			'visible' => 5,
			'parent' => 0,
			'pos' => $this->Azbn7->config['mysql'][0]['max_value']['js_int'],
			//'uid' => $this->Azbn7->randstr(32),
			'url' => $type['uid'] . '/' . date('Ymd') . '/' . $this->Azbn7->randstr(32),
			//'param' => $this->Azbn7->getJSON(array()),
		),
		'item' => array(
			'title' => $title,
			'path' => $path,
			//'param' => $this->Azbn7->getJSON(array()),
		),
	);
	
	$item['entity']['id'] = $this->Azbn7->mdl('Entity')->createEntity($item);
	
	$param['response']['entity'] = $item;
	$param['meta']['msg'] = array(
		'type' => 'info',
		'text' => 'Entity of ' . $type['uid'] . ' was created',
	);
	
}
