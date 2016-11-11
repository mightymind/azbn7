<?
class Viewer
{
	public $event_prefix = 'app.mdl.viewer';
	
	public function tpl($tpl, $param = array())
	{
		$tpl_uid = $this->Azbn7->randstr(16);
		
		if(!isset($this->Azbn7->mdl('Req')->data['headers_sended'])) {
			
			$this->Azbn7->mdl('Req')->genHeaders(true);
			
		}
		
		$file = $this->Azbn7->config['path']['app'] . '/tpl/' . strtolower($tpl) . '.tpl.php';
		
		if(file_exists($file)) {
			
			require($file);
			
		} else {
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.tpl.not_found',
				'title' => 'Tpl ' . $tpl . ' not found!',
			));
			
		}
		
	}
}