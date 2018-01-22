<?

if(count($_POST['item'])) {

	$item = array(
		'parent' => $this->Azbn7->as_num($_POST['item']['parent']),
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
	);
	
	$item['id'] = $this->Azbn7->mdl('DB')->create('state', $item);
	
	if($item['id']) {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/state/'));
		
	} else {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/add/state/'));
		
	}
	
}
