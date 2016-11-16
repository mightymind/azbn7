<?

if(count($_POST['item']) && count($_POST['type']) && count($_POST['entity'])) {
	
	$type_id = $this->Azbn7->as_int($_POST['type']['id']);
	
	$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$type_id}'");
	
	$type['param'] = json_decode($type['param'], true);
	
	$item = array(
		'type' => $type['uid'],
		'entity' => array(
			'visible' => $this->Azbn7->as_int($_POST['entity']['visible']),
			'parent' => $this->Azbn7->as_int($_POST['entity']['parent']),
			'pos' => $this->Azbn7->as_int($_POST['entity']['pos']),
			//'uid' => $this->Azbn7->randstr(32),
			'url' => $this->Azbn7->c_s($_POST['entity']['url']),
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'param' => $this->Azbn7->arr2json(array()),
		),
	);
	
	if(count($type['param']['field'])) {
		foreach($type['param']['field'] as $k => $v) {
			//if($v['wysiwyg'] == '') {}
			$item['item'][$k] = $this->Azbn7->ch($_POST['item'][$k]);
		}
	}
	
	$item['entity']['id'] = $this->Azbn7->mdl('Entity')->createEntity($item);
	
	//var_dump($item['item']);
	//die();
	
	if($item['entity']['id']) {
		
		$this->Azbn7->go2('/admin/all/entity/?type=' . $type_id);
		
	}
	
}
