<?

$item_id = $this->Azbn7->c_s($param[3]);

if($item_id) {
	$this->Azbn7->mdl('DB')->delete('alias', "id = '{$item_id}'");
}

$this->Azbn7->go2('/admin/all/alias/');
