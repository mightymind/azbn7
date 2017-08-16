<?

$entity_id = $this->Azbn7->as_num($param[3]);

$entity = $this->Azbn7->mdl('Entity')->item($entity_id);

if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.copy') && $entity['entity']['id']) {
	
	$item = array(
		'type' => $entity['type']['uid'],
		'entity' => array(
			'visible' => $this->Azbn7->as_num($entity['entity']['visible']),
			'parent' => $this->Azbn7->as_num($entity['entity']['parent']),
			'pos' => $this->Azbn7->as_num($entity['entity']['pos']),
			//'uid' => $this->Azbn7->randstr(32),
			'url' => $this->Azbn7->as_url($entity['entity']['url'] . '_copied_' . $this->Azbn7->created_at),
			'param' => $this->Azbn7->getJSON($entity['entity']['param']),
		),
		'item' => $entity['item'],
	);
	
	unset($item['item']['id']);
	
	$item['item']['param'] = $this->Azbn7->getJSON($item['item']['param']);
	
	$item['item']['title'] = $item['item']['title'] . ' (скопировано ' . date('d.m.Y', $this->Azbn7->created_at) . ')';
	
	$item['entity']['id'] = $this->Azbn7->mdl('Entity')->createEntity($item);
	
	if($item['entity']['id']) {
		
		$this->Azbn7->mdl('Session')->notify('user', array(
			'type' => 'success',
			'title' => 'Запись скопирована',
		));
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $item['entity']['id'] . '/'));
		
	} else {
		
		$this->Azbn7->mdl('Session')->notify('user', array(
			'type' => 'danger',
			'title' => 'Запись не скопирована',
		));
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/entity/' . $entity_id . '/'));
		
	}
	
	
	
} else {
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/'));
	
}

