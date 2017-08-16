<?

if(count($_POST['item'])) {
	
	$item = array(
		'fill' => $this->Azbn7->as_num($_POST['item']['fill']),
		'parent' => $this->Azbn7->as_num($_POST['item']['parent']),
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
		'field' => array(),
	);
	
	if(count($_POST['item']['param']['field'])) {
		foreach($_POST['item']['param']['field'] as $type) {
			
			$uid = $this->Azbn7->c_s($type['uid']);
			
			if($uid != '' && $uid != '0') {
				
				$item['field'][$uid] = array(
					'title' => $type['title'],
					'type' => $type['type'],
					'editor' => $type['editor'],
				);
				
			}
			
		}
	}
	
	//$item['param'] => $this->Azbn7->getJSON($item['param']);
	
	/*
	'field' => array(
			'title' => "VARCHAR(256) DEFAULT ''",
			'preview' => "TEXT DEFAULT ''",
			'content' => "MEDIUMTEXT DEFAULT ''",
		),
	*/
	
	$item['id'] = $this->Azbn7->mdl('Entity')->createType($item);
	
	if($item['id']) {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/entity_type/'));
		
	}
	
}
