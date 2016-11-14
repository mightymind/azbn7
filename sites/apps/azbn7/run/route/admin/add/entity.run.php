<?
// получение списка элементов

$type_id = $this->Azbn7->as_int($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");

$type['param'] = json_decode($type['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/add/entity', array(
		'type' => $type,
	))
;