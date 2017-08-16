<?

$item_id = $this->Azbn7->as_num($param[3]);

$item = $this->Azbn7->mdl('DB')->one('entity', "id = '{$item_id}'");

if($item['id']) {
	$this->Azbn7->mdl('DB')->delete('entity', "id = '{$item_id}'");
	
	$this->Azbn7->mdl('Site')
		->log('site.entity.delete', array(
			'entity' => $item_id,
		))
	;
}

$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $item['type']));
