<?
// получение списка элементов

$page = $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('page')) - 1;

if($page < 0) {
	$page = 0;
}

$start_at = $page * $this->Azbn7->config['pagination']['count'];

$log_user_str = '';
$log_profile_str = '';
$log_created_at_str = '';

if(isset($_GET['flt'])) {
	if(count($_GET['flt'])) {
		
		if($_GET['flt']['user'] != '' && $this->Azbn7->as_num($_GET['flt']['user']) != 0) {
			$log_user_str = "
				AND
				user = '" . $this->Azbn7->c_s($_GET['flt']['user']) . "'
			";
		}
		
		if($_GET['flt']['profile'] != '' && $this->Azbn7->as_num($_GET['flt']['profile']) != 0) {
			$log_profile_str = "
				AND
				profile = '" . $this->Azbn7->c_s($_GET['flt']['profile']) . "'
			";
		}
		
		if($_GET['flt']['created_at']['start'] != '') {
			$log_created_at_str = "
				AND
				created_at > '" . (strtotime($_GET['flt']['created_at']['start'] . ' 00:00:00') - 1) . "'
			";
		}
		
		if($_GET['flt']['created_at']['stop'] != '') {
			$log_created_at_str = $log_created_at_str . "
				AND
				created_at < '" . (strtotime($_GET['flt']['created_at']['stop'] . ' 00:00:00') - 0) . "'
			";
		}
		
	}
}

//$query = $this->Azbn7->mdl('DB')->q("SELECT SQL_CALC_FOUND_ROWS * FROM `" . $this->Azbn7->mdl('DB')->t['log'] . "` WHERE 1 ORDER BY id DESC LIMIT " . $start_at . ", " . $this->Azbn7->config['pagination']['count']);

$query = $this->Azbn7->mdl('DB')->q("
	SELECT
		SQL_CALC_FOUND_ROWS *
	FROM
		`" . $this->Azbn7->mdl('DB')->t['log'] . "`
	WHERE
		1
		$log_user_str
		$log_profile_str
		$log_created_at_str
	ORDER BY
		id DESC
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

$this->Azbn7->mdl('Site')
	->render('admin/all/log', array(
		'page' => $page,
		'count' => $count,
		'start_at' => $start_at,
		//'type' => $type,
		'items' => $items,
	))
;
