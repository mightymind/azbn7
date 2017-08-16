<?

if(count($_POST['item'])) {
	
	$item = array(
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
	);
	
	$item['id'] = $this->Azbn7->mdl('DB')->create('right', $item);
	
	if($item['id']) {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/right/'));
		
	} else {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/add/right/'));
		
	}
	
}
