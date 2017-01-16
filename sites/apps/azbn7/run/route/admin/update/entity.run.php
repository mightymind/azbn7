<?

if(count($_POST['item']) && count($_POST['entity'])) {
	
	$entity_id = $this->Azbn7->as_num($_POST['entity']['id']);
	
	$entity = $this->Azbn7->mdl('DB')->one('entity', "id = '{$entity_id}'");
	
	$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$entity['type']}'");
	
	$type['param'] = json_decode($type['param'], true);
	
	$item = array(
		'entity' => array(
			'updated_at' => $this->Azbn7->created_at,
			'visible' => $this->Azbn7->as_num($_POST['entity']['visible']),
			'parent' => $this->Azbn7->as_num($_POST['entity']['parent']),
			'pos' => $this->Azbn7->as_num($_POST['entity']['pos']),
			//'uid' => $this->Azbn7->randstr(32),
			'url' => $this->Azbn7->as_url($_POST['entity']['url']),
			'param' => $this->Azbn7->arr2json(array()),
		),
		'item' => array(
			'title' => $this->Azbn7->c_s($_POST['item']['title']),
			'param' => $this->Azbn7->arr2json(array()),
		),
	);
	
	if(count($type['param']['field'])) {
		foreach($type['param']['field'] as $k => $v) {
			//if($v['wysiwyg'] == '') {}
			$item['item'][$k] = $this->Azbn7->as_html($_POST['item'][$k]);
		}
	}
	
	$this->Azbn7->mdl('Entity')->updateEntity($entity['id'], $item);
	
	
	
	$this->Azbn7->mdl('DB')->delete('entity_bound', "child = '{$entity['id']}'");
	
	$bound_arr = json_decode($this->Azbn7->c_s($_POST['bound']), true);
	
	if(count($bound_arr)) {
		foreach($bound_arr as $b) {
			$this->Azbn7->mdl('Entity')->createBound(array(
				'parent' => $b,
				'child' => $entity['id'],
			));
		}
	}
	
	
	
	$this->Azbn7->mdl('Session')->notify('user', array(
		'type' => 'success',
		'title' => 'Запись обновлена',
	));
	
	$this->Azbn7->go2('/admin/edit/entity/' . $entity['id'] . '/');
	
}
