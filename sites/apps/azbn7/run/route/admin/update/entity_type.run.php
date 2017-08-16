<?

if(count($_POST['item'])) {
	
	$type_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$type_id}'");
	
	$type['param'] = $this->Azbn7->parseJSON($type['param']);
	
	$item = array(
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
		'fill' => $this->Azbn7->as_num($_POST['item']['fill']),
		'param' => $type['param'],
	);
	
	if(count($type['param']['field'])) {
		foreach($type['param']['field'] as $k => $v) {
			//if($v['wysiwyg'] == '') {}
			//unset($item['param']['field'][$k]['type']);
			$item['param']['field'][$k]['editor'] = $this->Azbn7->c_s($_POST['param']['field'][$k]['editor']);
		}
	}
	
	if(count($_POST['item']['param']['field'])) {
		foreach($_POST['item']['param']['field'] as $_type) {
			
			$uid = $this->Azbn7->c_s($_type['uid']);
			
			if($uid != '' && $uid != '0') {
				
				$item['param']['field'][$uid] = array(
					'title' => $this->Azbn7->c_s($_type['title']),
					//'type' => $this->Azbn7->c_s($_type['type']),
					'editor' => $this->Azbn7->c_s($_type['editor']),
				);
				
				$this->Azbn7->mdl('DB')->q("ALTER TABLE `" . $this->Azbn7->mdl('Entity')->getTable($type['uid']) . "` ADD `" . $uid . "` " . $_type['type']);
				
				//die("ALTER TABLE `" . $this->Azbn7->mdl('Entity')->getTable($type['uid']) . "` ADD COLUMN `" . $uid . "` " . $_type['type']);
				
			}
			
		}
	}
	
	//$this->Azbn7->mdl('Entity')->updateEntity($entity['id'], $item);
	
	$item['param'] = $this->Azbn7->getJSON($item['param']);
	
	$this->Azbn7->mdl('DB')->update('entity_type', $item, "id = '{$type_id}'");
	
	$this->Azbn7->mdl('Session')->notify('user', array(
		'type' => 'success',
		'title' => 'Запись обновлена',
	));
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/entity_type/' . $type_id . '/'));
	
}
