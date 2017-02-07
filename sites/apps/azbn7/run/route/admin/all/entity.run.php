<?
// получение списка элементов

$type_id = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('type'));

$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '$type_id'");
$type['param'] = $this->Azbn7->parseJSON($type['param']);

$page = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('page')) - 1;

if($page < 0) {
	$page = 0;
}

$start_at = $page * $this->Azbn7->config['pagination']['count'];

$entity_user_str = '';
$entity_visible_str = '';
$entity_created_at_str = '';
$entity_updated_at_str = '';

if(count($_GET['flt'])) {
	
	if($_GET['flt']['user'] != '' && $this->Azbn7->as_num($_GET['flt']['user']) != 0) {
		$entity_user_str = "
			AND
			user = '" . $this->Azbn7->as_num($_GET['flt']['user']) . "'
		";
	}
	
	if(isset($_GET['flt']['visible']) && $_GET['flt']['visible'] != '') {
		$entity_visible_str = "
			AND
			visible = '" . $this->Azbn7->as_num($_GET['flt']['visible']) . "'
		";
	}
	
	if($_GET['flt']['created_at']['start'] != '') {
		$entity_created_at_str = "
			AND
			created_at > '" . (strtotime($_GET['flt']['created_at']['start'] . ' 00:00:00') - 1) . "'
		";
	}
	
	if($_GET['flt']['created_at']['stop'] != '') {
		$entity_created_at_str = $entity_created_at_str . "
			AND
			created_at < '" . (strtotime($_GET['flt']['created_at']['stop'] . ' 00:00:00') - 0) . "'
		";
	}
	
	if($_GET['flt']['updated_at']['start'] != '') {
		$entity_updated_at_str = "
			AND
			updated_at > '" . (strtotime($_GET['flt']['updated_at']['start'] . ' 00:00:00') - 1) . "'
		";
	}
	
	if($_GET['flt']['updated_at']['stop'] != '') {
		$entity_updated_at_str = $entity_updated_at_str . "
			AND
			updated_at < '" . (strtotime($_GET['flt']['updated_at']['stop'] . ' 00:00:00') - 0) . "'
		";
	}
	
}

/*
Mysql> SELECT SQL_CALC_FOUND_ROWS * FROM table WHERE column > 1 LIMIT 0, 50;
Mysql> SELECT FOUND_ROWS();
*/

$query = $this->Azbn7->mdl('DB')->q("
	SELECT
		SQL_CALC_FOUND_ROWS *
	FROM
		`" . $this->Azbn7->mdl('DB')->t['entity'] . "`
	WHERE
		type = '{$type_id}'
		$entity_user_str
		$entity_visible_str
		$entity_created_at_str
		$entity_updated_at_str
	ORDER BY
		updated_at DESC
	LIMIT
		" . $start_at . ", " . $this->Azbn7->config['pagination']['count']);

if($query) {
	
	$count = $this->Azbn7->mdl('DB')->q('SELECT FOUND_ROWS() as count');
	$count = $count->fetchAll(\PDO::FETCH_ASSOC);
	$count = $this->Azbn7->as_num($count[0]['count']);
	
	$items = $query->fetchAll(\PDO::FETCH_ASSOC);
	
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