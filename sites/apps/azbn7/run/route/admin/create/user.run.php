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
		'pass' => $this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->c_s($_POST['item']['pass']), 'user', $this->Azbn7->c_s($_POST['item']['login'])),
		'key' => $this->Azbn7->c_s($_POST['item']['key']),
			//'key' => mb_strtoupper($this->Azbn7->mdl('Session')->getPassHash($this->Azbn7->randstr(32), 'api', $__user['login']), $this->Azbn7->config['charset']),
		'right' => $this->Azbn7->getJSON($rights),
		'param' => $this->Azbn7->getJSON(array(
			'theme' => $this->Azbn7->c_s($_POST['item']['param']['theme']),
			'theme_admin' => $this->Azbn7->c_s($_POST['item']['param']['theme_admin']),
			'lang' => $this->Azbn7->c_s($_POST['item']['param']['lang']),
			'wysiwyg' => $this->Azbn7->c_s($_POST['item']['param']['wysiwyg']),
		)),
	);
	
	$item['id'] = $this->Azbn7->mdl('DB')->create('user', $item);
	
	if($item['id']) {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/user/' . $item['id'] . '/'));
		
	} else {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/user/'));
		
	}
	
}
