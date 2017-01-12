<?

$item = $this->Azbn7->mdl('DB')->one('profile', "id = '{$param[3]}'");

$item['right'] = json_decode($item['right'], true);
$item['param'] = json_decode($item['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/edit/profile', array(
		'item' => $item,
		//'rights' => $this->Azbn7->mdl('DB')->read('right', '1 ORDER BY uid'),
	))
;
