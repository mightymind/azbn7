<?
/*
переиндексатор
*/

$event_prefix = $this->event_prefix . '.app.run.search.entity.reindex';

if(isset($param['entity']['id'])) {
	
	$entity = $this->Azbn7->mdl('Entity')->item($param['entity']['id']);
	
	if(is_array($entity['item'])) {
		if(count($entity['item'])) {
			//$entity['entity']['visible']
			
			$text = '';
			
			foreach($entity['item'] as $k => $v) {
				if(is_array($v) || is_object($v)) {
					
				} else {
					$text = $text . ' ' . $v;
				}
			}
			
			if($this->Azbn7->is_mdl('TextIndexer')) {
				
			} else {
				
				$this->Azbn7
					->load(array(
						'dir' => 'azbn7',
						'mdl' => 'TextIndexer',
						'uid' => 'TextIndexer',
						'param' => array()
					))
				;
				
			}
			
			$text_index = $this->Azbn7->mdl('TextIndexer')->getIndex($text);
			
			$entity_search = $this->Azbn7->mdl('DB')->one('entity_search', "entity = '{$param['entity']['id']}'");
			
			if($entity_search['id']) {
				
				$this->Azbn7->mdl('DB')->update('entity_search', array(
					'updated_at' => $this->Azbn7->created_at,
					'content' => $text_index,
				), "id = '{$entity_search['id']}'");
				
			} else {
				
				$this->Azbn7->mdl('DB')->create('entity_search', array(
					'entity' => $param['entity']['id'],
					'created_at' => $this->Azbn7->created_at,
					'updated_at' => $this->Azbn7->created_at,
					'content' => $text_index,
				));
				
			}
			
			$this->Azbn7->event(array(
				'action' => $event_prefix,
				'title' => 'Поиск: индексация ' . $param['entity']['id'],
			));
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.app.run.search.entity.reindex.after', $entity)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('Site')
				->log('site.entity.search.reindex', array(
					'entity' => $param['entity']['id'],
				))
			;
			
		}
	}
	
}