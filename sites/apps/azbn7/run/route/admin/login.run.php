<?

if(count($_POST)) {
	
	if($this->Azbn7->mdl('Session')->login('user', $this->Azbn7->mdl('Req')->_post('login'), $this->Azbn7->mdl('Req')->_post('pass'))) {
		
		$this->Azbn7->go2('/admin/');
		
	} else {
		
		sleep(3);
		
		$this->Azbn7->go2('/admin/login/');
		
	}
	
} else {
	
	$this->Azbn7->mdl('Site')
		->render('admin/login', array())
	;
	
}