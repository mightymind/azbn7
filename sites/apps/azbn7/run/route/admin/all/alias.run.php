<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/alias', array(
		'items' => $this->Azbn7->mdl('DB')->read('alias', "1 ORDER BY visible DESC, pos"),
	))
;