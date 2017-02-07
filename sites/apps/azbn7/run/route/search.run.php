<?
/*
основной поиск по сайту
*/

$param['search'] = array(
	'text' => mb_strtolower($this->Azbn7->mdl('Req')->_get('text'), $this->Azbn7->config['charset']),
	'type' => $this->Azbn7->as_num($this->Azbn7->mdl('Req')->_get('type')),
);

if($param['search']['text'] != '' && mb_strlen($param['search']['text'], $this->Azbn7->config['charset']) > 2) {
	
	echo 'поиск ' . $param['search']['text'];
	
	if($this->Azbn7->mdl('Site')->is('user')) {
		$visible_str = "(`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '10' OR `" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '5')";
	} else {
		$visible_str = "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.visible = '10'";
	}
	
	$type_str = '';
	
	if($param['search']['type']) {
		
		$type_str = "`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = '{$param['search']['type']}' AND ";
		
	} else {
		
	}
	
	$search_items_sql = $this->Azbn7->mdl('DB')->q("
		SELECT
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.updated_at AS indexed_at,
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.entity,
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.uid AS entity_type,
			MATCH (`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content) AGAINST ('{$param['search']['text']}' IN BOOLEAN MODE) as REL,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.*
		FROM
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`,
			`" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`
		WHERE
			`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.entity = `" . $this->Azbn7->mdl('DB')->t['entity'] . "`.id
			AND
			$visible_str
			AND
			$type_str
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.type = `" . $this->Azbn7->mdl('DB')->t['entity_type'] . "`.id
			AND
			(
				MATCH (`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content) AGAINST ('{$param['search']['text']}' IN BOOLEAN MODE) > 0
				OR
				`" . $this->Azbn7->mdl('DB')->t['entity_search'] . "`.content LIKE '%{$param['search']['text']}%'
			)
		ORDER BY
			REL DESC,
			`" . $this->Azbn7->mdl('DB')->t['entity'] . "`.pos,
			indexed_at
	");
	
	$search_items = $search_items_sql->fetchAll(\PDO::FETCH_ASSOC);
	
	if(count($search_items)) {
		
		$param['search']['items'] = array();
		
		foreach($search_items as $item) {
			
			$_item =  array(
				'entity' => $item,
				'item' => $this->Azbn7->mdl('DB')->one($this->Azbn7->mdl('Entity')->getTable($item['entity_type']), "entity = '{$item['entity']}'"),
			);
			
			$_item['entity']['param'] = $this->Azbn7->parseJSON($_item['entity']['param']);
			$_item['item']['param'] = $this->Azbn7->parseJSON($_item['item']['param']);
			
			$param['search']['items'][] = $_item;
			
		}
		
		if(count($param['search']['items'])) {
			foreach($param['search']['items'] as $item) {
				echo '<p>' . $this->Azbn7->mdl('Site')->url('/' . $item['entity']['url'] . '/') . '</p>';
			}
		}
		
	} else {
		
		echo 'ничего не найдено';
		
	}
	
	
} else {
	
	echo $param['search']['text'];
	
}