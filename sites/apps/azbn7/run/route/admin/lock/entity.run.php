<?

$action = $this->Azbn7->c_s($this->Azbn7->mdl('Req')->_get('action'));
$entity_id = $param[3];

$entity = $this->Azbn7->mdl('DB')->one('entity', "id = '{$entity_id}'");

$e = array(
	'entity' => &$entity,
);

if($this->Azbn7->mdl('Session')->hasRight('user', 'site.entity.lock')) {
	
	switch($action) {
		
		case 'unlock' : {
			
			$item = array(
				'locked_by' => 0,
			);
			
			$this->Azbn7->mdl('DB')->update('entity', $item, "id = '{$entity['id']}'");
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.app.run.route.admin.lock.entity.unlock', $e)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('Site')
				->log('site.entity.unlock', array(
					'entity' => $entity['id'],
				))
			;
			
		}
		break;
		
		default : {
			
			$item = array(
				'locked_by' => $this->Azbn7->mdl('Site')->is('user'),
			);
			
			$this->Azbn7->mdl('DB')->update('entity', $item, "id = '{$entity['id']}'");
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.app.run.route.admin.lock.entity.lock', $e)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('Site')
				->log('site.entity.lock', array(
					'entity' => $entity['id'],
				))
			;
			
		}
		break;
		
	}
	
} else {
	
	
	
}

$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/all/entity/?type=' . $entity['type']));
