<?

$tables = $this->Azbn7->mdl('DB')->read('entity_type');

if(count($tables)) {
	foreach($tables as $t) {
		
		$this->Azbn7->mdl('DB')
			->exec('DROP TABLE IF EXISTS `' . $this->Azbn7->mdl('Site')->getEntityTable($t['uid']) . '`')
		;
		
	}
}

if(count($this->Azbn7->mdl('DB')->t)) {
	foreach($this->Azbn7->mdl('DB')->t as $k => $v) {
		
		$this->Azbn7->mdl('DB')
			->exec('DROP TABLE IF EXISTS `' . $v . '`')
		;
		
	}
}

$this->Azbn7->go2('/install/main/');