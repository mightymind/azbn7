<?

if(count($_POST['item'])) {
	
	$item = array(
		'pos' => $this->Azbn7->as_num($_POST['item']['pos']),
		'visible' => $this->Azbn7->as_num($_POST['item']['visible']),
		'find' => $this->Azbn7->c_s($_POST['item']['find']),
		'set' => $this->Azbn7->c_s($_POST['item']['set']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
	);
	
	$item['id'] = $this->Azbn7->mdl('DB')->create('alias', $item);
	
	if($item['id']) {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/alias/'));
		
	} else {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/add/alias/'));
		
	}
	
}
