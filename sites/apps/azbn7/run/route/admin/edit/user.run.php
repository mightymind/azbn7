<?

$item = $this->Azbn7->mdl('DB')->one('user', "id = '{$param[3]}'");

$item['right'] = $this->Azbn7->parseJSON($item['right']);
$item['param'] = $this->Azbn7->parseJSON($item['param']);

$this->Azbn7->mdl('Site')
	->render('admin/edit/user', array(
		'item' => $item,
		//'rights' => $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid'),
	))
;
