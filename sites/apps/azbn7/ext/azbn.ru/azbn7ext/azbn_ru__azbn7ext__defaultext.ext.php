<?

class Azbn_ru__Azbn7Ext__DefaultExt
{
	public $data = array();
	public $event_prefix = 'app.ext.azbn_ru__azbn7ext__defaultext';
	
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