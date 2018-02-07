<?php

namespace app;

class Entity
{
	public $event_prefix = '';//'app.mdl.entity';
	public $cache = array();
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function getTable($uid = 'page', $sub = '')
	{
		if($sub != '') {
			$sub = '_' . $sub;
		}
		return $this->Azbn7->mdl('DB')->prefix . "_" . $uid . $sub;
	}
	
	public function createType($e = array())
	{
		if(isset($e['uid']) && isset($e['title'])) {
			
			$field_struct_arr = array();
			
			if(count($e['field'])) {
				foreach($e['field'] as $k => $v) {
					$field_struct_arr[$k] = array(
						//'type' => $this->Azbn7->c_s($v['type']),
						'editor' => $this->Azbn7->c_s($v['editor']),
						'title' => $this->Azbn7->c_s($v['title']),
					);
				}
			}
			
			$e['id'] = $this->Azbn7->mdl('DB')->create('entity_type', array(
				'fill' => (isset($e['fill']) ? $e['fill'] : 1),
				'parent' => $this->Azbn7->as_num($e['parent']),
				'uid' => $e['uid'],
				'title' => $e['title'],
				'param' => $this->Azbn7->getJSON(array(
					'field' => $field_struct_arr,
				)),
			), true);
			
			if($e['id']) {
				
				$field_str = '';
				$field_arr = array();
				
				if(count($e['field'])) {
					foreach($e['field'] as $k => $v) {
						$field_arr[] = "`$k` {$v['type']}";
					}
					$field_str = implode(', ', $field_arr);
				}
				
				$this->Azbn7->mdl('DB')
					
					->exec("CREATE TABLE IF NOT EXISTS `" . $this->getTable($e['uid']) . "` (
							`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
							`entity` BIGINT DEFAULT '0',
							`title` VARCHAR(255) DEFAULT '',
							{$field_str} ,
							`param` MEDIUMBLOB DEFAULT NULL,
							FOREIGN KEY (entity) REFERENCES " . $this->Azbn7->mdl('DB')->t['entity'] . "(id) ON DELETE CASCADE
						) ENGINE=" . $this->Azbn7->mdl('DB')->engine . " DEFAULT CHARSET=" . $this->Azbn7->mdl('DB')->charset . ";
					")
				;
				
				/*
				$this->Azbn7->mdl('DB')->update('entity_type', array('param' => array(
					'field' => array(
						
					))));
				*/
				
				$this->Azbn7->event(array(
					'action' => $this->event_prefix . '.create.entity_type.after',
					'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.create.entity_type.after') . ': ' . $e['uid'],
				));
				
				
				/* ---------- ext__event ---------- */
				$this->Azbn7
					->mdl('Ext')
						->event($this->event_prefix . '.create.entity_type.after', $e)
				;
				/* --------- /ext__event ---------- */
				
				
				$this->Azbn7->mdl('Site')
					->log('site.entity.create.entity_type', array(
						'id' => $e['id'],
						'uid' => $e['uid'],
					))
				;
				
				$this->Azbn7->mdl('DB')->create('right', array('uid' => 'site.entity.type.' . $e['uid'] . '.access', 'title' => 'Доступ к записям типа ' . $e['title']));
				
				return intval($e['id']);
				
			} else {
				
				return 0;
				
			}
			
		} else {
			
			return 0;
			
		}
	}
	
	public function createEntity($e = array(
			'type' => 'page',
			'entity' => array(),
			'item' => array(),
			'route' => array(),
		))
	{
		
		$type = $this->Azbn7->mdl('DB')->one('entity_type', "uid = '{$e['type']}'");
		
		$e['entity']['type'] = $type['id'];
		$e['entity']['created_at'] = $this->Azbn7->created_at;
		$e['entity']['updated_at'] = $this->Azbn7->created_at;
		$e['entity']['user'] = $this->Azbn7->mdl('Site')->is('user');
		$e['entity']['profile'] = $this->Azbn7->mdl('Site')->is('profile');
		
		if($type['fill']) {
			
			$e['entity']['id'] = $this->Azbn7->mdl('DB')->create('entity', $e['entity']);
			
			if($e['entity']['id']) {
				
				$e['item']['entity'] = &$e['entity']['id'];
				
				$e['item']['id'] = $this->Azbn7->mdl('DB')->create($this->getTable($type['uid']), $e['item']);
				
				if($e['item']['id']) {
					
					$this->createRoute($e);
					
					$this->Azbn7->run('app', 'search/entity/reindex', $e);
					
					$this->Azbn7->event(array(
						'action' => $this->event_prefix . '.create.entity.after',
						'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.create.entity.after') . ': ' . $e['entity']['id'],
					));
					
					/* ---------- ext__event ---------- */
					$this->Azbn7
						->mdl('Ext')
							->event($this->event_prefix . '.create.entity.after', $e)
					;
					/* --------- /ext__event ---------- */
					
					
					$this->Azbn7->mdl('Site')
						->log('site.entity.create.entity', array(
							'entity' => $e['entity']['id'],
						))
					;
					
					return intval($e['entity']['id']);
					
				} else {
					
					return 0;
					
				}
				
			} else {
				
				return 0;
				
			}
			
		} else {
			
			return 0;
			
		}
	
	}
	
	public function createRoute($e = array())
	{
		if($e['entity']['id']) {
			
			$route = array(
				'url' => $e['entity']['url'],
				'redirect' => $e['route']['redirect'],
				//'alias' => '',
				'entity' => array(
					'id' => $e['entity']['id'],
					//'url' => $e['entity']['url'],
				),
				'run' => array(
					'path' => $e['route']['run']['path'],
					'param' => array(),
				),
				/*
				'tpl' => array(
					'_' . '/header',
					'entity/by_type/' . $e['type'],
					'_' . '/footer',
				),
				*/
			);
			
			$route_str = $this->Azbn7->getJSON($route);
			
			$route_dir = $this->Azbn7->config['path']['route'] . '/' . $e['entity']['url'];
			
			if(file_exists($route_dir)) {
				
			} else {
				@mkdir($route_dir, 0777, true);
			}
			
			$this->Azbn7->w2f($route_dir . '/route.json', $route_str);
			
		}
	}
	
	public function createBound($b = array(
		'parent' => 0,
		'child' => 0,
	))
	{
		$res = 0;
		
		$bound = $this->Azbn7->mdl('DB')->one('entity_bound', "parent = '{$b['parent']}' AND child = '{$b['child']}'");
		
		if($bound['id']) {
			
			$res = intval($bound['id']);
			
		} else {
			
			$b['id'] = $this->Azbn7->mdl('DB')->create('entity_bound', $b);
			
			$res = intval($b['id']);
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.create.entity_bound.after',
				'title' => $this->Azbn7->mdl('Lang')->msg($this->event_prefix . '.create.entity_bound.after') . ': ' . $res,
			));
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.create.entity_bound.after', $b)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('Site')
				->log('site.entity.create.entity_bound', array(
					'entity' => $b['parent'],
					'parent' => $b['parent'],
					'child' => $b['child'],
					'id' => $b['id'],
				))
			;
			
		}
		
		return $res;
		
	}
	
	public function getRoute($e = array())
	{
		$route_file = $this->Azbn7->config['path']['route'] . '/' . $e['entity']['url'] . '/route.json';
		
		$res = array();
		
		if(file_exists($route_file)) {
			$res = $this->Azbn7->parseJSON(file_get_contents($route_file));
		}
		
		return $res;
	}
	
	public function getItems($_type = 0, $where_entities = '1', $where_items = '1')
	{
		$items = array();
		
		$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$_type}' OR uid = '{$_type}'");
		
		if($type['id']) {
			
			$entities = $this->Azbn7->mdl('DB')->read('entity', "type = '{$type['id']}' AND $where_entities");
			
			if(count($entities)) {
				
				foreach($entities as $e) {
					
					$items[] = $this->item($e['id']);
					
				}
				
			}
			
		}
		
		return $items;
	}
	
	public function getBounds($parent = null, $child = null)
	{
		$parent_str = '1';
		$child_str = '1';
		
		if($parent) {
			$parent_str = "parent = '$parent'";
		}
		
		if($child) {
			$child_str = "child = '$child'";
		}
		
		return $this->Azbn7->mdl('DB')->read('entity_bound', "$parent_str AND $child_str");
	}
	
	public function url($id = 0)
	{
		$entity = array();
		$res = '';
		
		if(isset($this->cache[$id]) && is_array($this->cache[$id])) {
			
			$entity = &$this->cache[$id];
			
		} else {
			
			$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
			
		}
		
		if($entity['entity']['id']) {
			$res = '/' . $entity['entity']['url'] . '/';
		}
		
		return $res;
	}
	
	public function item($id = 0, $url = '')
	{
		$entity = array(
			'entity' => array(
				'visible' => 0,
			),
			'type' => array(),
			'item' => array(),
			'cache' => 0,
		);
		
		if(isset($this->cache[$id]) && is_array($this->cache[$id])) {
			
			$entity = &$this->cache[$id];
			
		} else {
			
			if($id) {
				
				$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "id = '{$id}'");
				
			} elseif($url != '') {
				
				$entity['entity'] = $this->Azbn7->mdl('DB')->one('entity', "url = '{$url}'");
				
			} else {
				
			}
			
			if(isset($entity['entity']['id'])) {
				
				$id = $entity['entity']['id'];
				
				$entity['entity']['param'] = $this->Azbn7->parseJSON($entity['entity']['param']);
				
				$entity['type'] = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$entity['entity']['type']}'");
				if(isset($entity['type']['id'])) {
					$entity['type']['param'] = $this->Azbn7->parseJSON($entity['type']['param']);
				}
				
				$entity['item'] = $this->Azbn7->mdl('DB')->one($this->getTable($entity['type']['uid']), "entity = '{$entity['entity']['id']}'");
				if(isset($entity['item']['id'])) {
					$entity['item']['param'] = $this->Azbn7->parseJSON($entity['item']['param']);
				}
				
				$this->cache[$id] = $entity;
				$this->cache[$id]['cache'] = 1;
				
			} else {
				
			}
			
		}
		
		if($this->Azbn7->mdl('Site')->is('user')) {
			
		} elseif($this->Azbn7->mdl('Site')->is('profile') && $entity['entity']['visible'] > 0) {
			
		} elseif($entity['entity']['visible'] == 10) {
			
		} else {
			$entity = array();
		}
		
		return $entity;
	}
	
	public function updateEntity($id = 0, $e = array('entity' => array(), 'item' => array(),))
	{
		
		$entity = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
		
		if($entity['id'] && $entity['locked_by'] == 0) {
			
			$this->Azbn7->mdl('DB')->update('entity', $e['entity'], "id = '$id'");
			
			$e['entity']['id'] = $entity['id'];
			
			$type = $this->Azbn7->mdl('DB')->one('entity_type', "id = '{$entity['type']}'");
			
			if($type['id']) {
				
				$this->Azbn7->mdl('DB')->update($this->getTable($type['uid']), $e['item'], "entity = '$id'");
				
				$this->createRoute($e);
				
				/* ---------- ext__event ---------- */
				$this->Azbn7
					->mdl('Ext')
						->event($this->event_prefix . '.update.entity.after', $e)
				;
				/* --------- /ext__event ---------- */
				
				
				$this->Azbn7->run('app', 'search/entity/reindex', $e);
				
			}
			
		}
		
	}
	
	public function deleteEntity($id = 0)
	{
		
		$e = array();
		
		$e['entity'] = $this->Azbn7->mdl('DB')->one('entity', "id = '$id'");
		
		if($e['entity']['id']) {
			
			
			/* ---------- ext__event ---------- */
			$this->Azbn7
				->mdl('Ext')
					->event($this->event_prefix . '.delete.entity.before', $e)
			;
			/* --------- /ext__event ---------- */
			
			
			$this->Azbn7->mdl('DB')->delete('entity', "id = '$id'");
			
			$type = $this->Azbn7->mdl('DB')->one('type', "id = '{$e['entity']['type']}'");
			
			if($type['id']) {
				
				$this->Azbn7->mdl('DB')->delete($this->getTable($type['uid']), "entity = '$id'");
				
			}
			
			$routejson = $this->Azbn7->config['path']['route'] . '/' . $e['entity']['url'] . '/route.json';
			
			if(file_exists($routejson)) {
				unlink($routejson);
			}
			
		}
		
	}

	public function getStates($id = 0)
	{
		
		$result = array();

		$__semi_res = array();

		$items = $this->Azbn7->mdl('DB')->read('entity_state', "`entity` = '{$id}' ORDER BY `created_at`");

		if(count($items)) {
			
			foreach($items as $item) {
				$__semi_res[] = $item['state'];
			}

			$states = $this->Azbn7->mdl('DB')->read('state', "`id` IN (" . implode(',', $__semi_res) . ")");
			$__semi_res = array();
			if(count($states)) {
				foreach($states as $state) {
					$__semi_res[$state['id']] = $state;
				}
			}

			foreach($items as $item) {
				$item['state_uid'] = $__semi_res[$item['state']]['uid'];
				$item['state_title'] = $__semi_res[$item['state']]['title'];
				$item['param'] = $this->Azbn7->parseJSON($item['param'] != '' ? $item['param'] : '{}');
				$result[$item['id']] = $item;
			}

		}

		return $result;

	}

	public function getActiveStates($id = 0)
	{
		
		$result = array();

		$states = $this->getActiveStatesByIds($id);

		if(count($states)) {
			
			$items = $this->Azbn7->mdl('DB')->read('state', "`id` IN (" . implode(',', $states) . ")");

			if(count($items)) {
				foreach($items as $item) {
					$result[$item['uid']] = 1;
				}
			}

		}

		return $result;

	}

	public function getActiveStatesByIds($id = 0)
	{
		
		$states = array();

		$now = $this->Azbn7->created_at;

		$items = $this->Azbn7->mdl('DB')->read('entity_state', "`entity` = '{$id}' AND `deleted_at` = '0' AND `created_at` < '{$now}'");

		if(count($items)) {
			foreach($items as $item) {

				$states[] = $item['state'];

			}
		}

		return $states;

	}

	public function inState($id = 0, $state = 'default')
	{
		
		$result = false;

		$item = $this->Azbn7->mdl('DB')->one('state', "`uid` = '{$state}'");

		if($item['id']) {
			$result = $this->inStateById($id, $item['id']);
		}

		return $result;

	}

	public function inStateById($id = 0, $state = 0)
	{

		$now = $this->Azbn7->created_at;

		$states = $this->Azbn7->mdl('DB')->read('entity_state', "`entity` = '{$id}' AND `state` = '{$state}' AND `deleted_at` = '0' AND `created_at` < '{$now}'");

		if(count($states)) {
			return true;
		} else {
			return false;
		}

	}

	public function createState($id = 0, $state = 'default', $p = array())
	{

		$result = 0;

		$item = $this->Azbn7->mdl('DB')->one('state', "`uid` = '{$state}'");

		if($item['id']) {

			if($this->inStateById($id, $item['id'])) {

			} else {

				$result = $this->createStateById($id, $item['id'], $p);

			}

		}

		return $result;

	}

	public function createStateById($id = 0, $state = 0, $p = array())
	{

		return $this->Azbn7->mdl('DB')->create('entity_state', array(
			'entity' => $id,
			'state' => $state,
			'created_at' => $this->Azbn7->created_at,
			'deleted_at' => 0,
			'param' => $this->Azbn7->parseJSON($p),
		));

	}

	public function deleteState($id = 0, $state = 'default', $param = array())
	{
		
		$item = $this->Azbn7->mdl('DB')->one('state', "`uid` = '{$state}'");

		if($item['id']) {

			$this->deleteStateById($id, $item['id']);//, $param

		}

	}

	public function deleteStateById($id = 0, $state = 0)//, $param = array()
	{

		$this->Azbn7->mdl('DB')->update('entity_state', array(
			'deleted_at' => $this->Azbn7->created_at,
		), "`entity` = '{$id}' AND `state` = '{$state}' AND `deleted_at` = '0'");

	}
	
}