<?

$item_id = $this->Azbn7->as_num($param[3]);

if($item_id) {
	$this->Azbn7->mdl('DB')->delete('right', "id = '{$item_id}'");
}

$this->Azbn7->go2('/admin/all/right/');