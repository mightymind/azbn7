<?
// получение списка элементов

$type_id = $this->Azbn7->as_int($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");
$type['param'] = json_decode($type['param'], true);

$this->Azbn7->mdl('Site')
	->render('admin/all/entity', array(
		'type' => $type,
		'items' => $this->Azbn7->mdl('DB')->read('entity', "type = '{$type_id}' ORDER BY updated_at DESC"),
	))
;