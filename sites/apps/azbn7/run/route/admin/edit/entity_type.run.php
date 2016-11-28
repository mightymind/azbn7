<?


$item = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$param[3]}'");

$item['param'] = json_decode($item['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/edit/entity_type', array(
		'item' => $item,
	))
;