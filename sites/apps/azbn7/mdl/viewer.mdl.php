<?
class Viewer
{
	public $event_prefix = 'app.mdl.viewer';
	
	public $body_class = 'azbn7';
	public $is_admin_tpl = false;
	
	public function tpl($tpl, $param = array())
	{
		
		$tpl_uid = $this->Azbn7->randstr(16);
		
		if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
			
			$this->Azbn7->mdl('Req')->genHeaders(true);
			
		}
		
		$file = $this->Azbn7->config['path']['app'] . '/tpl/' . $this->Azbn7->config['theme'] . '/' . strtolower($tpl) . '.tpl.php';
		
		if(file_exists($file)) {
			
			require($file);
			
		} else {
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.tpl.not_found',
				'title' => 'Tpl ' . $tpl . ' not found!',
			));
			
		}
		
	}
	
	public function addBodyClass($class = '')
	{
		$this->body_class = $this->body_class . ' ' . $class;
	}
	
	public function bodyClass($class = '')
	{
		return $this->body_class . $class;
	}
	
}