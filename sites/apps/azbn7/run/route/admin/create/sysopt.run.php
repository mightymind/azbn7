<?

if(count($_POST['item'])) {
	
	$item = array(
		'json' => $this->Azbn7->as_num($_POST['item']['json']),
		'editable' => $this->Azbn7->as_num($_POST['item']['editable']),
		'editor' => $this->Azbn7->c_s($_POST['item']['editor']),
		'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'value' => $_POST['item']['value'],
	);

	$opt = $this->Azbn7->mdl('DB')->one('sysopt', "uid = '{$item['uid']}'");

	if($opt['id']) {
		
		
		
	} else {
		
		$item['id'] = $this->Azbn7->mdl('DB')->create('sysopt', $item);
		
	}

	if($item['id']) {
		
		$this->Azbn7->mdl('DB')->create('sysopt_data', array('uid' => $item['uid'], 'title' => $this->Azbn7->c_s($_POST['item']['data']['title'])));
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/sysopt/'));
		
	} else {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/add/sysopt/'));
		
	}
	
}
