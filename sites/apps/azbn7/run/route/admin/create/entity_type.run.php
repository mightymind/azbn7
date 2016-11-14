<?

if(count($_POST['item'])) {
	
	$item = array(
		'parent' => $this->Azbn7->c_s($_POST['item']['parent']),
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
		'field' => array(),
	);
	
	if(count($_POST['item']['param']['field'])) {
		foreach($_POST['item']['param']['field'] as $type) {
			
			$uid = $this->Azbn7->c_s($type['uid']);
			
			$item['field'][$uid] = array(
				'type' => $type['type'],
				'editor' => $type['editor'],
			);
			
		}
	}
	
	//$item['param'] => $this->Azbn7->arr2json($item['param']);
	
	/*
	'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'preview' => "TEXT DEFAULT ''",
			'content' => "MEDIUMTEXT DEFAULT ''",
		),
	*/
	
	$item['id'] = $this->Azbn7->mdl('Entity')->createType($item);
	
	if($item['id']) {
		
		$this->Azbn7->go2('/admin/all/entity_type/');
		
	}
	
}
