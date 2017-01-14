<?

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'Access-Control-Allow-Origin: *',
		'Content-type: application/xml; charset=' . $this->Azbn7->config['charset'],
	));

if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
	
	$this->Azbn7->mdl('Req')->genHeaders(true);
	
}

$types = $this->Azbn7->mdl('Site')->sysopt_get('site.sitemap.types');

if($types) {
	$items = $this->Azbn7->mdl('DB')->read('entity', "visible = '10' AND type IN ($types) ORDER BY id DESC");
} else {
	$items = $this->Azbn7->mdl('DB')->read('entity', "visible = '10' AND type = '1' ORDER BY id DESC");
}

$this->Azbn7->mdl('Viewer')
	->tpl('_/sitemap', array(
		'items' => $items,
	))
;