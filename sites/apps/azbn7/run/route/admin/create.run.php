<?

if(count($_POST['_']) && count($_POST['item'])) {
	
	if(isset($_POST['_']['table'])) {
		
		$this->Azbn7->run('app', 'route/admin/create/' . $this->Azbn7->c_s($_POST['_']['table']), $param);
		
	}
	
}
