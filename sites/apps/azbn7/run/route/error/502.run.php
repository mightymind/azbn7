<?

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'HTTP/1.1 502 Bad Gateway',
		'Status: 502 Bad Gateway',
		'Content-type: text/html; charset=' . $this->Azbn7->config['charset'],
	));

//$this->Azbn7->mdl('Viewer')
//	->tpl('404/index', array())
//;
$this->Azbn7->mdl('Site')
	->render('error/502', array())
;