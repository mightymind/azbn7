<?

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'Access-Control-Allow-Origin: *',
		'Content-type: text/plain; charset=' . $this->Azbn7->config['charset'],
	));

if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
	
	$this->Azbn7->mdl('Req')->genHeaders(true);
	
}

$content = $this->Azbn7->mdl('Site')->sysopt_get('site.robots.content');

echo $content;
