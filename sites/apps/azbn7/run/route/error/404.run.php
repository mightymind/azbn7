<?

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'HTTP/1.1 404 Not Found',
		'Status: 404 Not Found',
		'Content-type: text/html; charset=' . $this->Azbn7->config['charset'],
	));

//$this->Azbn7->mdl('Viewer')
//	->tpl('404/index', array())
//;
$this->Azbn7->mdl('Site')
	->render('error/404', array())
;