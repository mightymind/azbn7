<?

if(count($_POST['item']) && count($_POST['type']) && count($_POST['entity'])) {
	
	$type_id = $this->Azbn7->as_num($_POST['type']['id']);
	
	$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$type_id}'");
	
	$type['param'] = $this->Azbn7->parseJSON($type['param']);
	
	$item = array(
		'type' => $type['uid'],
		'entity' => array(
			'visible' => $this->Azbn7->as_num($_POST['entity']['visible']),
			'parent' => $this->Azbn7->as_num($_POST['entity']['parent']),
			'pos' => $this->Azbn7->as_num($_POST['entity']['pos']),
			//'uid' => $this->Azbn7->randstr(32),
			'url' => $this->Azbn7->as_url($_POST['entity']['url']),
			'param' => $this->Azbn7->getJSON(array()),
		),
		'item' => array(
			'title' => $this->Azbn7->c_s($_POST['item']['title']),
			'param' => $this->Azbn7->getJSON(array()),
		),
		'route' => array(
			'redirect' => $this->Azbn7->c_s($_POST['route']['redirect']),
			'run' => array(
				'path' => $this->Azbn7->c_s($_POST['route']['run']['path']),
				'param' => array(),
			),
		),
	);
	
	if(count($type['param']['field'])) {
		foreach($type['param']['field'] as $k => $v) {
			$item['item'][$k] = $this->Azbn7->as_html($_POST['item'][$k]);
		}
	}
	
	$item['entity']['id'] = $this->Azbn7->mdl('Entity')->createEntity($item);
	
	if($item['entity']['id']) {
		
		$this->Azbn7->mdl('DB')->delete('entity_bound', "child = '{$item['entity']['id']}'");
		
		$bound_arr = $this->Azbn7->parseJSON($this->Azbn7->c_s($_POST['bound_as-child']));
		
		if(count($bound_arr)) {
			foreach($bound_arr as $b) {
				$this->Azbn7->mdl('Entity')->createBound(array(
					'parent' => $b,
					'child' => $item['entity']['id'],
				));
			}
		}
		
		
		$this->Azbn7->mdl('DB')->delete('entity_bound', "parent = '{$item['entity']['id']}'");
		
		$bound_arr = $this->Azbn7->parseJSON($this->Azbn7->c_s($_POST['bound_as-parent']));
		
		if(count($bound_arr)) {
			foreach($bound_arr as $b) {
				$this->Azbn7->mdl('Entity')->createBound(array(
					'parent' => $item['entity']['id'],
					'child' => $b,
				));
			}
		}
		
		
		$this->Azbn7->mdl('Session')->notify('user', array(
			'type' => 'success',
			'title' => 'Запись добавлена',
		));
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $item['entity']['id'] . '/'));
		
	}
	
}
