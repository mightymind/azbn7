<?

$item_id = $this->Azbn7->c_s($param[3]);

$item = $this->Azbn7->mdl('DB')->one('entity', "id = '{$item_id}'");

if($item['id']) {
	$this->Azbn7->mdl('DB')->delete('entity', "id = '{$item_id}'");
}

$this->Azbn7->go2('/admin/all/entity/?type=' . $item['type']);
