<?


$item = $this->Azbn7->mdl('DB')->one('state', "id = '{$param[3]}'");

//$item['param'] = $this->Azbn7->parseJSON($item['param']);

$this->Azbn7->mdl('Site')
	->render('admin/edit/state', array(
		'item' => $item,
	))
;