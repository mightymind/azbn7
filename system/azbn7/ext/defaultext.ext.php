<?
class DefaultExt
{
	public $data = array();
	public $event_prefix = 'system.azbn7.ext.defaultext';
	
	function __construct()
	{
		//echo $this->event_prefix;
	}
	
	public function test1($uid)
	{
		echo '<br />ext event: ' . $uid . ': ' . $this->event_prefix;
	}
	
	public function test2($uid)
	{
		echo '<br />ext event: ' . $uid . ': ' . $this->event_prefix;
	}
	
}