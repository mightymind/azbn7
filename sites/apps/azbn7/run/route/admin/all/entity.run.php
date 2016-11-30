<?
// получение списка элементов

$type_id = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");
$type['param'] = json_decode($type['param'], true);

$page = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('page')) - 1;

if($page < 0) {
	$page = 0;
}

$start_at = $page * $this->Azbn7->config['pagination']['count'];

/*
Mysql> SELECT SQL_CALC_FOUND_ROWS * FROM table WHERE column > 1 LIMIT 0, 50;
Mysql> SELECT FOUND_ROWS();
*/

$query = $this->Azbn7->mdl('DB')->q("SELECT SQL_CALC_FOUND_ROWS * FROM `" . $this->Azbn7->mdl('DB')->t['entity'] . "` WHERE type = '{$type_id}' ORDER BY updated_at DESC LIMIT " . $start_at . ", " . $this->Azbn7->config['pagination']['count']);
if($query) {
	
	$count = $this->Azbn7->mdl('DB')->q('SELECT FOUND_ROWS() as count');
	$count = $count->fetchAll(PDO::FETCH_ASSOC);
	$count = $this->Azbn7->as_num($count[0]['count']);
	
	$items = $query->fetchAll(PDO::FETCH_ASSOC);
	
} else {
	
	$items = array();
	
}

//$items = $this->Azbn7->mdl('DB')->read('entity', "type = '{$type_id}' ORDER BY updated_at DESC");

$this->Azbn7->mdl('Site')
	->render('admin/all/entity', array(
		'page' => $page,
		'count' => $count,
		'start_at' => $start_at,
		'type' => $type,
		'items' => $items,
	))
;