<?

$item_id = $this->Azbn7->as_num($param[3]);

if($item_id) {
	$this->Azbn7->mdl('DB')->delete('alias', "id = '{$item_id}'");
}

$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/alias/'));
