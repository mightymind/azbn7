<?

$this->Azbn7->mdl('Req')
	->addHeaders(array(
		'Access-Control-Allow-Origin: *',
		'Content-type: application/json; charset=' . $this->Azbn7->config['charset'],
	));

if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
	
	$this->Azbn7->mdl('Req')->genHeaders(true);
	
}

if($this->Azbn7->is_mdl('Uploader')) {
	
} else {
	
	$this->Azbn7
		->load(array(
			'dir' => 'azbn7',
			'mdl' => 'Uploader',
			'uid' => 'Uploader',
			'param' => array()
		))
	;
	
	$this->Azbn7->mdl('Uploader')->initUploader(array(
		'path' => $this->Azbn7->config['path']['upload'],
	));
}

$uploaded = $this->Azbn7->mdl('Uploader')->from_dataurl(array(
	//'path' => 'dev',
	'name' => 'uploading_file',
));

if($uploaded['uploaded']) {
	
	$uploaded['url'] = '/' . $uploaded['fullname'];
	
}

echo $this->Azbn7->getJSON($uploaded);