<?
/*
основной обработчик API

$request = array(
	'method' => 'entity/item/get',
	'key' => 'public',
)

*/

$key = $this->Azbn7->mdl('Req')->_post('key');
$access_as = isset($_POST['access_as']) ? $this->Azbn7->mdl('Req')->_post('access_as') : 'user';

$access = $this->Azbn7->mdl('DB')->one($access_as, "`key` = '$key'");

if($access['id']) {
	
	$access['right'] = $this->Azbn7->parseJSON($access['right']);
	//$access['param'] = $this->Azbn7->parseJSON($access['param']);
	
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
			'version_api' => 1,
			'created_at' => $this->Azbn7->created_at,
			'created_at_str'=>date('Y/m/d H:i:s', $this->Azbn7->created_at),
			'platform'=>'Azbn7',
			'access' => array(
				'access_as' => $access_as,
				'id' => $access['id'],
				'right' => $access['right'],
			),
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
	
	$this->Azbn7->run('app', 'api/v1/' . $this->Azbn7->mdl('Req')->_post('method'), $resp);
	
	echo $this->Azbn7->getJSON($resp);
	
} else {
	
	
	
}