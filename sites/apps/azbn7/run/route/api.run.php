<?
/*
основной обработчик API

$request = array(
	'method' => 'entity/item/get',
	'key' => 'public',
)

*/

$key = $this->Azbn7->mdl('Req')->_post('key');
$atype = isset($_POST['atype']) ? $this->Azbn7->mdl('Req')->_post('atype') : 'user';

$access = $this->Azbn7->mdl('DB')->one($atype, "`key` = '$key'");

if($access['id']) {
	
	$this->Azbn7->mdl('Req')
		->addHeaders(array(
			'Access-Control-Allow-Origin: *',
			'Content-type: application/json; charset=' . $this->Azbn7->config['charset'],
		));
	
	if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
		
		$this->Azbn7->mdl('Req')->genHeaders(true);
		
	}
	
	$resp = array(
		'meta' => array(
			'version' => $this->Azbn7->version['number'],
			'created_at' => $this->Azbn7->created_at,
			'created_at_str'=>date('Y/m/d H:i:s', $this->Azbn7->created_at),
			'platform'=>'Azbn7',
			'msg' => array(
				'type' => 'info',
				'text' => 'info message',
			),
			'need' => array(
				'reload' => 0,
			),
			'notifies' => array(),
		),
		'response' => array(
			'entity' => array(),
			'entities' => array(),
		),
	);
	
	$this->Azbn7->run('app', 'api/' . $this->Azbn7->mdl('Req')->_post('method'), $resp);
	
	echo $this->Azbn7->getJSON($resp);
	
} else {
	
	
	
}