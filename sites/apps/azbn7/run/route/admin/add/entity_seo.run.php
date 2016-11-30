<?
// получение списка элементов

$this->Azbn7->mdl('Site')
	->render('admin/add/entity_seo', array(
		//'entities' => $this->Azbn7->mdl('DB')->read('sysopt'),
	))
;