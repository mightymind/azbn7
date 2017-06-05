<?

$items = $this->Azbn7->mdl('DB')->join(
	"`" . $this->Azbn7->mdl('DB')->t['sysopt_data'] . "`, `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "`",
	"`" . $this->Azbn7->mdl('DB')->t['sysopt'] . "`.id = '{$param[3]}' AND `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "`.uid = `" . $this->Azbn7->mdl('DB')->t['sysopt_data'] . "`.uid",
	"`" . $this->Azbn7->mdl('DB')->t['sysopt_data'] . "`.title, `" . $this->Azbn7->mdl('DB')->t['sysopt'] . "`.*"
);

if(count($items) == 1) {
	
	$this->Azbn7->mdl('Site')
		->render('admin/edit/sysopt', array(
			'item' => $items[0],
		))
	;
	
} else {
	
	$item = $this->Azbn7->mdl('DB')->one('sysopt', "id = '{$param[3]}'");
	
	$this->Azbn7->mdl('Site')
		->render('admin/edit/sysopt', array(
			'item' => $item,
		))
	;
	
}