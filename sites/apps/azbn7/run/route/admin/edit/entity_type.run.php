<?


$item = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$param[3]}'");

$item['param'] = $this->Azbn7->parseJSON($item['param']);

$this->Azbn7->mdl('Site')
	->render('admin/edit/entity_type', array(
		'item' => $item,
	))
;