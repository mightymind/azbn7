<?
/*
основной обработчик API

$request = array(
	'method' => 'entity/item/get',
	'key' => 'public',
)

*/

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'Access-Control-Allow-Origin: *',
		'Content-type: application/json; charset=' . $this->Azbn7->config['charset'],
	));

if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
	
	$this->Azbn7->mdl('Req')->genHeaders(true);
	
}

$resp = array(
	'info' => array(
		'version' => $this->Azbn7->version['number'],
		'created_at' => $this->Azbn7->created_at,
		'created_at_str'=>date('Y/m/d H:i:s', $this->Azbn7->created_at),
		'platform'=>'Azbn7',
		'msg' => array(
			'type' => 'info',
			'text' => 'info message',
		),
	),
	'response' => array(
		'entity' => array(),
		'entities' => array(),
	),
);

$this->Azbn7->run('app', 'api/' . $this->Azbn7->mdl('Req')->_post('method'), $resp);

echo $this->Azbn7->arr2json($resp);