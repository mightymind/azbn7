<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['id']);
	
	$rights = array();
	if(count($_POST['item']['right'])) {
		foreach($_POST['item']['right'] as $uid => $value) {
			$value = $this->Azbn7->as_int($value);
			if($value) {
				$rights[$uid] = $value;
			}
		}
	}
	
	$item = array(
		'login' => $this->Azbn7->c_s($_POST['item']['login']),
		'email' => $this->Azbn7->c_email($_POST['item']['email']),
		'right' => $this->Azbn7->getJSON($rights),
		'param' => $this->Azbn7->getJSON(array(
			'theme' => $this->Azbn7->c_s($_POST['item']['param']['theme']),
			'lang' => $this->Azbn7->c_s($_POST['item']['param']['lang']),
			'wysiwyg' => $this->Azbn7->c_s($_POST['item']['param']['wysiwyg']),
		)),
	);
	
	if(isset($_POST['item']['pass']) && $_POST['item']['pass'] != '') {
		$item['pass'] = $this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->c_s($_POST['item']['pass']), 'profile', $item['login']);
	}
	
	if(isset($_POST['item']['key']) && $_POST['item']['key'] != '') {
		$item['key'] = $this->Azbn7->c_s($_POST['item']['key']);
	}
	
	$this->Azbn7->mdl('DB')->update('profile', $item, "id = '$item_id'");
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/profile/' . $item_id . '/'));
	
}
