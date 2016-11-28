<?

$item = $this->Azbn7->mdl('DB')->one('profile', "id = '{$param[3]}'");

$item['param'] = json_decode($item['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/edit/profile', array(
		'item' => $item,
	))
;
