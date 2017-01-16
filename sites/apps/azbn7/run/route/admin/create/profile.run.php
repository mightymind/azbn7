<?

if(count($_POST['item'])) {
	
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
		'created_at' => $this->Azbn7->created_at,
		'login' => $this->Azbn7->c_s($_POST['item']['login']),
		'email' => $this->Azbn7->c_email($_POST['item']['email']),
		'pass' => $this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->c_s($_POST['item']['pass']), 'profile', $this->Azbn7->c_s($_POST['item']['login'])),
		'right' => $this->Azbn7->getJSON($rights),
		'param' => $this->Azbn7->getJSON(array(
			'theme' => $this->Azbn7->c_s($_POST['item']['param']['theme']),
			'lang' => $this->Azbn7->c_s($_POST['item']['param']['lang']),
			'wysiwyg' => $this->Azbn7->c_s($_POST['item']['param']['wysiwyg']),
		)),
	);
	
	$item['id'] = $this->Azbn7->mdl('DB')->create('profile', $item);
	
	if($item['id']) {
		
		$this->Azbn7->go2('/admin/edit/profile/' . $item['id'] . '/');
		
	} else {
		
		$this->Azbn7->go2('/admin/all/profile/');
		
	}
	
}
