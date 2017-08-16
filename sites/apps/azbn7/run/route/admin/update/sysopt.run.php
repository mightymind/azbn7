<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$item = array(
		'json' => $this->Azbn7->as_num($_POST['item']['json']),
		'editable' => $this->Azbn7->as_num($_POST['item']['editable']),
		'editor' => $this->Azbn7->c_s($_POST['item']['editor']),
		//'uid' => $this->Azbn7->c_s($_POST['item']['uid']),
		'value' => $_POST['item']['value'],
	);
	
	$opt = $this->Azbn7->mdl('DB')->one('sysopt', "id = '$item_id'");
	
	if($opt['editable']) {
		
		$this->Azbn7->mdl('DB')->update('sysopt_data', array('title' => $this->Azbn7->c_s($_POST['item']['data']['title'])), "uid = '{$opt['uid']}'");
		
		$this->Azbn7->mdl('DB')->update('sysopt', $item, "id = '$item_id'");
		
	}
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/sysopt/' . $item_id . '/'));
	
}
