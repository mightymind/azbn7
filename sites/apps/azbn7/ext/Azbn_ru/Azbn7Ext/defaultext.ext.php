<?

namespace app\Ext\Azbn_ru\Azbn7Ext;

class DefaultExt
{
	public $data = array();
	public $event_prefix = 'app.ext.azbn_ru.azbn7ext.defaultext';
	
	function __construct()
	{
		//echo $this->event_prefix;
	}
	
	public function test1($uid)
	{
		echo '<br />ext event (' . __NAMESPACE__ . '): ' . $uid . ': ' . $this->event_prefix;
	}
	
	public function test2($uid)
	{
		echo '<br />ext event (' . __NAMESPACE__ . '): ' . $uid . ': ' . $this->event_prefix;
	}
	
}