<?
// получение списка элементов

$type_id = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");
$type['param'] = $this->Azbn7->parseJSON($type['param']);

$query = $this->Azbn7->mdl('DB')->q("
	SELECT
		SQL_CALC_FOUND_ROWS *
	FROM
		`" . $this->Azbn7->mdl('DB')->t['entity'] . "`
	WHERE
		type = '{$type_id}'
	ORDER BY
		pos, id
	");

if($query) {
	
	$count = $this->Azbn7->mdl('DB')->q('SELECT FOUND_ROWS() as count');
	$count = $count->fetchAll(\PDO::FETCH_ASSOC);
	$count = $this->Azbn7->as_num($count[0]['count']);
	
	$items = $query->fetchAll(\PDO::FETCH_ASSOC);
	
} else {
	
	$items = array();
	
}

$this->Azbn7->mdl('Site')
	->render('admin/tree/entity', array(
		'count' => $count,
		'type' => $type,
		'items' => $items,
	))
;