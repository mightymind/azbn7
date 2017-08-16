<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$item = array(
		'pos' => $this->Azbn7->as_num($_POST['item']['pos']),
		'visible' => $this->Azbn7->as_num($_POST['item']['visible']),
		'find' => $this->Azbn7->c_s($_POST['item']['find']),
		'set' => $this->Azbn7->c_s($_POST['item']['set']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
	);
	
	$this->Azbn7->mdl('DB')->update('alias', $item, "id = '$item_id'");
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/alias/' . $item_id . '/'));
	
}
