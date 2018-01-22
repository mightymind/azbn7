<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$type = $this->Azbn7->mdl('DB')->one('state', "id = '{$item_id}'");
	
	$item = array(
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
		'parent' => $this->Azbn7->as_num($_POST['item']['parent']),
	);
	
	$this->Azbn7->mdl('DB')->update('state', $item, "id = '{$item_id}'");
	
	$this->Azbn7->mdl('Session')->notify('user', array(
		'type' => 'success',
		'title' => 'Запись обновлена',
	));
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/state/' . $item_id . '/'));
	
}
