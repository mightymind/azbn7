<?


/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->event_prefix . '.app.run.route.install.clear.before')
;
/* --------- /ext__event ---------- */


$tables = $this->Azbn7->mdl('DB')->read('entity_type');

if(count($tables)) {
	foreach($tables as $t) {
		
		$this->Azbn7->mdl('DB')
			->exec('DROP TABLE IF EXISTS `' . $this->Azbn7->mdl('Entity')->getTable($t['uid']) . '`')
		;
		
		$this->Azbn7->mdl('Site')
			->log('site.db.drop_table', array(
				'table' => $this->Azbn7->mdl('Entity')->getTable($t['uid']),
			))
		;
		
	}
}

if(count($this->Azbn7->mdl('DB')->t)) {
	foreach($this->Azbn7->mdl('DB')->t as $k => $v) {
		
		$this->Azbn7->mdl('DB')
			->exec('DROP TABLE IF EXISTS `' . $v . '`')
		;
		
		$this->Azbn7->mdl('Site')
			->log('site.db.drop_table', array(
				'table' => $v,
			))
		;
		
	}
}


/* ---------- ext__event ---------- */
$this->Azbn7
	->mdl('Ext')
		->event($this->event_prefix . '.app.run.route.install.clear.after')
;
/* --------- /ext__event ---------- */


$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/install/main/'));