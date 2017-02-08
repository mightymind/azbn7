<?

namespace app\Ext\Azbn_ru\Azbn7Ext;

class DefaultExt
{
	public $data = null;
	public $event_prefix = '';//__NAMESPACE__ . '\DefaultExt';
	
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
					array($this->Azbn7->mdl('DB')->event_prefix . '.connect.before'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'storage_mysql__connect__before',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('DB')->event_prefix . '.connect.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'storage_mysql__connect__after',
						),
					))
				
				->addListeners(
					array($this->event_prefix . $this->Azbn7->mdl('Ext')->ext__ns_delimiter . 'api.ext'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => '__api_ext',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.head.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'viewer__header_head_after',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.footer.body.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'viewer__footer_body_after',
						),
					))
				
				->addListeners(
					array($this->Azbn7->mdl('Viewer')->event_prefix . '.tpl.header.body.navbar.settings.after'),
					array(
						array(
							'dir' => 'app',
							'ext' => $this->event_prefix,
							'method' => 'viewer__header_body_navbar_settings__after',
						),
					))
				
		;
		
	}
	
	public function installExt()
	{
		
		$this->data['created_at'] = $this->Azbn7->created_at;
		
		
		
		$this->saveData();
		
	}
	
	public function loadData()
	{
		
		$__data = $this->Azbn7->mdl('Site')->sysopt_get($this->event_prefix);
		
		if($__data) {
			
			$this->data = $__data;
			
		} else {
			
			$this->saveData();
			
		}
		
	}
	
	public function saveData()
	{
		
		$this->Azbn7->mdl('Site')->sysopt_set($this->event_prefix, (object) $this->data);
		
	}
	
	public function storage_mysql__connect__before($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется перед подключением к БД<br />', $this->event_prefix);
	}
	
	public function storage_mysql__connect__after($uid, &$p = array())
	{
		//$this->Azbn7->echo_dev('Этот код выполняется после подключения к БД<br />', $this->event_prefix);
		
		$this->loadData();
		
		if($this->data['created_at']) {
			
		} else {
			
			$this->installExt();
			
		}
		
	}
	
	public function __api_ext($uid, &$p = array())
	{
		
		$this->data['counter']++;
		
		$p['meta']['msg']['text'] = 'it is ext response #' . $this->data['counter'] . '! ' . __NAMESPACE__ . ' ' . $this->event_prefix;
		
		$this->saveData();
		
	}
	
	public function viewer__header_head_after($uid, &$p = array())
	{
		$uid = str_replace('.', '__', $this->event_prefix);
		$this->Azbn7->mdl('Viewer')->addBodyClass($uid);
		$this->Azbn7->mdl('Viewer')->addBodyDataAttr($uid, $this->Azbn7->getJSON($this->data));
		
		echo '<!-- header -->';
	}
	
	public function viewer__footer_body_after($uid, &$p = array())
	{
		echo '<!-- footer -->';
	}
	
	public function viewer__header_body_navbar_settings__after($uid, &$p = array())
	{
		?>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="<?=$this->Azbn7->mdl('Site')->url('/admin/');?>" >Пункт в меню, добавленный расширением</a>
		<?
	}
	
}