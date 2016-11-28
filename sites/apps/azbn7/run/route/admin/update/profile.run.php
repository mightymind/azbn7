<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_int($_POST['item']['id']);
	
	$item = array(
		'login' => $this->Azbn7->c_s($_POST['item']['login']),
		'email' => $this->Azbn7->c_s($_POST['item']['email']),
		'param' => $this->Azbn7->arr2json(array(
			'theme' => $this->Azbn7->c_s($_POST['item']['param']['theme']),
			'lang' => $this->Azbn7->c_s($_POST['item']['param']['lang']),
			'wysiwyg' => $this->Azbn7->c_s($_POST['item']['param']['wysiwyg']),
		)),
	);
	
	if(isset($_POST['item']['pass']) && $_POST['item']['pass'] != '') {
		$item['pass'] = $this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->c_s($_POST['item']['pass']), 'profile', $item['login']);
	}
	
	$this->Azbn7->mdl('DB')->update('profile', $item, "id = '$item_id'");
	
	$this->Azbn7->go2('/admin/edit/profile/' . $item_id . '/');
	
}