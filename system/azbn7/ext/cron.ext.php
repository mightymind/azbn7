<?php

namespace azbn7\Ext;

class Cron
{
	public $data = null;
	public $event_prefix = '';
	public $need_runTasks = array();
	
	function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
		$this->data = array();
	}
	
	public function connectToListeners()
	{
		
		$this->Azbn7
			->mdl('Ext')
				
				->addListeners(
					array($this->Azbn7->mdl('DB')->event_prefix . '.connect.after'),
					array(
						array(
							'dir' => 'azbn7',
							'ext' => $this->event_prefix,
							'method' => 'storage_mysql__connect__after',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.footer.body.after'),
					array(
						array(
							'dir' => 'azbn7',
							'ext' => $this->event_prefix,
							'method' => 'viewer__tpl__footer_body__after',
						),
					))
				
				->addListeners(
					array($this->event_prefix . $this->Azbn7->mdl('Ext')->ext__ns_delimiter . 'tasks.run'),
					array(
						array(
							'dir' => 'azbn7',
							'ext' => $this->event_prefix,
							'method' => 'ajax__tasks_run',
						),
					))
				
		
		;
		
	}
	
	public function installExt()
	{
		
		$this->data['created_at'] = $this->Azbn7->created_at;
		
		$this->data['tasks'] = array();
		
		$this->saveData();
		
	}
	
	public function loadData()
	{
		
		$__data = $this->Azbn7->mdl('Site')->sysopt_get($this->event_prefix);
		
		if($__data) {
			
			$this->data = $__data;
			
			if(count($this->data['tasks'])) {
				
				foreach($this->data['tasks'] as $task_index => $task) {
					
					if(!$task['is_single'] || ($task['is_single'] && !$task['is_single_runned'])) {
						
						if(($task['lastact'] + $task['period']) < $this->Azbn7->created_at) {
							
							$this->need_runTasks[] = $task_index;
							
						}
						
					}
					
				}
				
			}
			
		} else {
			
			$this->saveData();
			
		}
		
	}
	
	public function saveData()
	{
		
		$this->Azbn7->mdl('Site')->sysopt_set($this->event_prefix, (object) $this->data);
		
	}
	
	public function setTask($task = array())
	{
		/*
		$task = array(
			'uid' => '',
			'is_single' => 1,
			'lastact' => 0,
			'period' => 0,
			'run' => array(
				'dir' => '',
				'path' => '',
			)
		)
		*/
		
		$task['created_at'] = $this->Azbn7->created_at;
		
		$this->data['tasks'][$task['uid']] = $task;
		
		$this->saveData();
		
	}
	
	public function runTasks(&$p = array())
	{
		if(count($this->need_runTasks)) {
			
			$t_arr = array();
			
			foreach($this->need_runTasks as $task_index) {
				
				$task = $this->data['tasks'][$task_index];
				
				$task['lastact'] = $this->Azbn7->created_at;
				
				if($task['is_single']) {
					$task['is_single_runned'] = 1;
				}
				
				$this->data['tasks'][$task_index] = $task;
				
				$t_arr[] = $task;
				
			}
			
			$this->saveData();
			
			foreach($t_arr as $task) {
				
				$this->Azbn7->run($task['run']['dir'], $task['run']['path'], $p);
				
			}
			
		}
	}
	
	public function storage_mysql__connect__after($uid, &$p = array())
	{
		$this->loadData();
		
		if($this->data['created_at']) {
			
		} else {
			
			$this->installExt();
			
		}
		
	}
	
	/*
	public function req__request__before($uid, &$p = array())
	{
		$this->Azbn7->mdl('Req')->addHeaders(array(
			'X-Azbn7-Ext-Cron: ' . $this->event_prefix,
		));
	}
	*/
	
	public function viewer__tpl__footer_body__after($uid, &$p = array())
	{
		if(count($this->need_runTasks)) {
		?>
		<script defer >
			$(function(){
				
				Azbn7.api({
					method : 'ext',
					event : '<?=$this->event_prefix . $this->Azbn7->mdl('Ext')->ext__ns_delimiter . 'tasks.run';?>',
				}, function(resp){console.log(resp.meta.msg.text)});
				
			});
		</script>
		<?
		}
	}
	
	public function ajax__tasks_run($uid, &$p = array())
	{
		
		$p['meta']['msg']['text'] = '';
		
		$this->runTasks($p);
		
		$p['meta']['msg']['text'] = $p['meta']['msg']['text'] . "\n" . $uid . ' finished';
		
	}
	
}