<?
// получение списка элементов

$page = $this->Azbn7->as_int($this->Azbn7->mdl('Req')->_get('page')) - 1;

if($page < 0) {
	$page = 0;
}

$start_at = $page * $this->Azbn7->config['pagination']['count'];

$query = $this->Azbn7->mdl('DB')->q("SELECT SQL_CALC_FOUND_ROWS * FROM `" . $this->Azbn7->mdl('DB')->t['log'] . "` WHERE 1 ORDER BY id DESC LIMIT " . $start_at . ", " . $this->Azbn7->config['pagination']['count']);
if($query) {
	
	$count = $this->Azbn7->mdl('DB')->q('SELECT FOUND_ROWS() as count');
	$count = $count->fetchAll(PDO::FETCH_ASSOC);
	$count = $this->Azbn7->as_int($count[0]['count']);
	
	$items = $query->fetchAll(PDO::FETCH_ASSOC);
	
} else {
	
	$items = array();
	
}

$this->Azbn7->mdl('Site')
	->render('admin/all/log', array(
		'page' => $page,
		'count' => $count,
		'start_at' => $start_at,
		//'type' => $type,
		'items' => $items,
	))
;
