<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/all/log', array(
		'items' => $this->Azbn7->mdl('DB')->read('log'),
	))
;