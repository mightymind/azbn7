<?

$item = $this->Azbn7->mdl('DB')->one('user', "id = '{$param[3]}'");

$item['param'] = json_decode($item['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/edit/user', array(
		'item' => $item,
	))
;
