<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$item = array(
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
	);
	
	$this->Azbn7->mdl('DB')->update('right', $item, "id = '$item_id'");
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/right/' . $item_id . '/'));
	
}
