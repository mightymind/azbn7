<?php

namespace azbn7 {
	
	class Azbn7
	{
		// Переменные класса
		public $config = array();
		public $data = array();
		public $timing = array();
		public $__events = array();
		public $__errors = array();
		public $__modules = array();
		public $version = array(
			'number' => 0.1103,
			'update_at' => '201701161426',
			'secret' => 'NemoMeImpuneLacessit',
			'php' => 0.0,
		);
		public $event_prefix = 'system.azbn7';
		public $php_process_session = '';
		
		public function __construct($config = array()) // Конструктор класса
		{
			$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
			
			$this->config = $config;
			$this->created_at = $this->as_num(date('U'));
			$this->data = array();
			$this->timing['start'] = $this->getMicroTime();
			$this->php_process_session = md5("\n" . date('U') . rand(0, 10000));
			
			$version = explode('.', phpversion());
			$this->version['php'] = $version[0] + round($version[1] / 10, 1);
			
			$this->Azbn7 = &$this;
			
			set_error_handler(array(&$this,'onError'));
			set_exception_handler(array(&$this, 'onException'));
		}
		
		public function __destruct()
		{
			
		}
		
		public function echo_dev($str = '', $src = '')
		{
			if($this->config['debug']) {
				echo "\n" . '<!-- ---------- ' . ($src != '' ? $src : $this->event_prefix) . ': ' . $str . ' ---------- -->' . "\n";
			}
		}
		
		public function getTiming($m = 0)
		{
			if($m == 0) {
				$m = $this->$this->getMicroTime();
			}
			
			return ($m - $this->timing['start']);
		}
		
		public function event($arr)
		{
			/*
			array(
				'title' => 'заголовок',
			)
			*/
			$arr['created_at'] = $this->getMicroTime();
			$arr['timing'] = $this->getTiming($arr['created_at']);
			$arr['memory'] = memory_get_usage();
			
			if($arr['action'] == 'error') {
				$this->__errors[] = $arr;
			}
			
			$this->__events[] = $arr;
			
			return $this;
		}
		
		public function onError($errno, $errstr, $errfile, $errline)
		{
			$this->event(array(
				'action' => 'error',
				'type' => 'error',
				'id' => $errno,
				'title' => 'Err: '.$errstr,
				'file' => $errfile.':'.$errline,
			));
			return $this;
		}
		
		public function onException($e)
		{
			$fp = fopen($this->config['path']['cache'] . '/exceptions.log', 'a');
			fwrite($fp, $this->getMicroTime() . ' exc#'.$e->getCode() . ' ' . $e->getFile() . ':' . $e->getLine() . ' ' . $e->getMessage() . ' ' . $e->getTraceAsString() . "\n");
			fclose($fp);
			return $this;
		}
		
		public function load($arr)
		{
			/*
			array(
				'dir' => 'папка',
				'mdl' => 'имя класса',
				'uid' => 'уникальный ID',
				'param' => array()
			)
			*/
			
			$class_name = '\\' . $arr['dir'] . '\\' . str_replace('/', '\\', $arr['mdl']);
			
			if(isset($this->__modules[$arr['uid']])) {
				unset($this->__modules[$arr['uid']]);
				unset($this->data['mdl'][$arr['uid']]);
			}
			
			$file = $this->config['path'][$arr['dir']] . '/mdl/' . strtolower($arr['mdl']) . '.mdl.php';
			
			if(file_exists($file)) {
				
				require($file);
				
				//echo $class_name . '<br />';
				
				$this->__modules[$arr['uid']] = new $class_name($arr['param']);//$arr['mdl']
				
				/*
				if($this->__modules[$arr['uid']]) {
					echo $class_name . '<br />';
				}
				*/
				
				$this->data['mdl'][$arr['uid']] = array();
				
				$this->__modules[$arr['uid']]->Azbn7 = &$this;
				$this->__modules[$arr['uid']]->data = &$this->data['mdl'][$arr['uid']];
				
				$this->event(array(
					'action' => $this->event_prefix . '.load.after',
					'title' => $arr['mdl'] . ' was loaded as '. $arr['uid'],
				));
				
			}
			
			return $this;
		}
		
		public function mdl($uid)
		{
			if($this->__modules[$uid]) {
				return $this->__modules[$uid];
			} else {
				return $this;
			}
		}
		
		public function is_mdl($uid)
		{
			if($this->__modules[$uid]) {
				return true;
			} else {
				return false;
			}
		}
		
		public function run($dir, $file, &$param)
		{
			$file = $this->config['path'][$dir] . '/run/' . $file . '.run.php';
			
			if(file_exists($file)) {
				require($file);
			}
			
			return $this;
		}
		
		public function hash($str, $salt1 = '', $salt2 = '')
		{
			return md5($salt1."\n".$salt2.$str);
		}

		
		public function as_int($value = 0)
		{
			return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
		}
		
		public function as_num($value = 0)
		{
			//return ($this->is_num($value)?($value):float($value));
			
			return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		}
		
		public function is_num($value = 0)
		{
			if (preg_match("#^[0-9]+$#",$value)) {
				return true;
			} else {
				return false;
			}
		}
		
		public function as_html($value = '')
		{
			//return strtr(stripcslashes($string), $changes);
			return filter_var($value, FILTER_UNSAFE_RAW, FILTER_FLAG_NO_ENCODE_QUOTES);
		}
		
		public function as_url($value = '')
		{
			return filter_var($value, FILTER_SANITIZE_URL);
		}
		
		public function c_s($value = '')
		{
			//return htmlspecialchars(trim($string), ENT_QUOTES, $this->config['charset']);
			
			//FILTER_SANITIZE_NUMBER_INT
			//FILTER_SANITIZE_NUMBER_FLOAT
			//FILTER_SANITIZE_EMAIL
			//FILTER_SANITIZE_SPECIAL_CHARS
			//FILTER_SANITIZE_FULL_SPECIAL_CHARS
			
			return filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}

		public function c_email($value = '')
		{
			//return htmlspecialchars((substr(trim(strtolower($email)), 0, 64)), ENT_QUOTES, $this->config['charset']);
			return substr(filter_var($value, FILTER_SANITIZE_EMAIL), 0, 64);
		}

		/*
		Перенаправление на другой адрес
		*/

		public function go2($url = '/')
		{
			Header('HTTP/1.1 301 Moved Permanently'); 
			Header('Location: ' . $url);
			return $this;
		}

		/*
		Отправка почты
		*/

		public function mail2($to, $from, $subject, $body, $headers=array())
		{
			$headers_str = "From: $from\r\n" . "Reply-To: $from\r\n";
			if(count($headers)) {
				foreach($headers as $param=>$value) {
					$headers_str=$headers_str."$param: $value\r\n";
				}
			}
			@mail($to, $subject, $body, $headers_str);
			return $this;
		}
		
		public function is_email($email = '')
		{
			return preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $email);
		}
		
		public function get_utc($year = 0, $month = 0, $day = 0, $hour = 0, $min = 0, $sec = 0)
		{
			return date('U', mktime($hour,$min,$sec,$month,$day,$year));
		}
		
		public function get_formdate($tpl = 'YmdHis', $year = 0, $month = 0, $day = 0, $hour = 0, $min = 0, $sec = 0)
		{
			return date($tpl, mktime($hour,$min,$sec,$month,$day,$year));
		}
		
		public function get_date($utc)
		{
			/*
				Array(
				[seconds] => 40
				[minutes] => 58
				[hours]   => 21
				[mday]    => 17
				[wday]    => 2
				[mon]     => 6
				[year]    => 2003
				[yday]    => 167
				[weekday] => Tuesday
				[month]   => June
				[0]       => 1055901520
				)
			*/
			return getdate($utc);
		}
		
		public function w2f($file, $str = '')
		{
			$fp = fopen($file, "w");
			fwrite($fp, $str);
			fclose($fp);
			return $this;
		}
		
		public function getMicroTime()
		{
			return microtime(1);
		}
		
		public function randstr($len, $sym = false)
		{
			$tpl = 'qwertyuiopasdfghjklzxcvbnm0192837465';
			if($sym) {
				$tpl .= '-_+=()%$#@!*^&\|/:';
			}
			$str='';
			for($i = 0; $i < $len; $i++) {
				$str .= $tpl[rand(0, strlen($tpl) - 1)];
			}
			return $str;
		}
		
		public function ru2en($str = '')
		{
			$str = mb_strtolower($str, $this->config['charset']);
			$str = strtr($str,array(
				'а'=>'a',	'б'=>'b',	'в'=>'v',	'г'=>'g',	'д'=>'d',	'е'=>'e',	'ё'=>'yo',	'ж'=>'zh',	'з'=>'z',	'и'=>'i',
				'й'=>'yi',	'к'=>'k',	'л'=>'l',	'м'=>'m',	'н'=>'n',	'о'=>'o',	'п'=>'p',	'р'=>'r',	'с'=>'s',	'т'=>'t',
				'у'=>'u',	'ф'=>'f',	'х'=>'h',	'ц'=>'ts',	'ч'=>'ch',	'ш'=>'sh',	'щ'=>'shch',	'ъ'=>'',	'ы'=>'y',	'ь'=>'',
				'э'=>'e',	'ю'=>'yu',	'я'=>'ya',
				//'А'=>'A',	'Б'=>'B',	'В'=>'V',	'Г'=>'G',	'Д'=>'D',	'Е'=>'E',	'Ё'=>'Yo',	'Ж'=>'Zh',	'З'=>'Z',	'И'=>'I',
				//'Й'=>'Yi',	'К'=>'K',	'Л'=>'L',	'М'=>'M',	'Н'=>'N',	'О'=>'O',	'П'=>'P',	'Р'=>'R',	'С'=>'S',	'Т'=>'T',
				//'У'=>'U',	'Ф'=>'F',	'Х'=>'H',	'Ц'=>'Ts',	'Ч'=>'Ch',	'Ш'=>'Sh',	'Щ'=>'Shch',	'Ъ'=>'',	'Ы'=>'Y',	'Ь'=>'',
				//'Э'=>'E',	'Ю'=>'Yu',	'Я'=>'Ya',
				));
			$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
			$str = trim($str, "-");
			return $str;
		}
		
		public function getJSON_prepareUTF($matches){
			return json_decode('"' . $matches[1] . '"');
		}
		
		public function getJSON($_a = array()) // arr2json
		{
			$a = &$_a;
			
			if($this->version['php'] > 5.3) {
				return json_encode($a, JSON_UNESCAPED_UNICODE);
			} else {
				return stripslashes(preg_replace_callback('/((\\\u[01-9a-fA-F]{4})+)/', array(&$this, 'getJSON_prepareUTF'),
					json_encode($a)
				));
			}
		}
		
		public function parseJSON($j) // json2arr
		{
			return json_decode($j, true);
		}
		
		public function wget($url = '', $p = array())
		{
			return file_get_contents($url);
		}
		
	}
	
}