<?php

namespace azbn7;

class Uploader
{
	public $path = '';
	public $uploaded = 0;
	public $event_prefix = '';//'system.azbn7.mdl.uploader';
	
	public $mime_type = array(
		
		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',
		
		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',
		
		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',
		
		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',
		'mp4' => 'video/mp4',
		'webm' => 'video/webm',
		
		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',
		
		// ms office
		'rtf' => 'application/rtf',
		'doc' => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'xls' => 'application/vnd.ms-excel',
		'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'ppt' => 'application/vnd.ms-powerpoint',
		'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		
		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	);
	
	public function __construct()
	{
		$this->event_prefix = strtolower(str_replace('\\', '.', static::class));
	}
	
	public function initUploader($config = array())
	{
		
		if(count($config)) {
			
			if($config['path']) {
				$this->path = $this->path . $config['path'] . '/';
			}
			
		}
		
		$this->uploaded = 0;
		
		//mkdir($structure, 0777, true)
		
	}
	
	public function makePath($path)
	{
		if(file_exists($path)) {
			
		} else {
			@mkdir($path, 0777, true);
		}
	}
	
	public function save($param = array())
	{
		/*
		$param = array(
			'path' => папка загрузки
			'name' => имя поля для загрузки файла,
			//'new_file'=>$new_file,
			//'suff'=>$suff
		);
		*/
		
		/*
		
Содержимое массива $_FILES для нашего примера приведено ниже. Обратите внимание, что здесь предполагается использование имени userfile для поля выбора файла, как и в приведенном выше примере. На самом деле имя поля может быть любым.
$_FILES['userfile']['name']
Оригинальное имя файла на компьютере клиента.
$_FILES['userfile']['type']
Mime-тип файла, в случае, если браузер предоставил такую информацию. Пример: "image/gif". Этот mime-тип не проверяется в PHP, так что не полагайтесь на его значение без проверки.
$_FILES['userfile']['size']
Размер в байтах принятого файла.
$_FILES['userfile']['tmp_name']
Временное имя, с которым принятый файл был сохранен на сервере.
$_FILES['userfile']['error']
Код ошибки, которая может возникнуть при загрузке файла. Этот элемент был добавлен в PHP 4.2.0
		
		*/
		
		$path = $this->path;
		
		if($param['path']) {
			$path = $path . $param['path'] . '/';
		}
		
		$path = $path . date('Y/m/d') . '/';
		
		$this->makePath($path);
		
		if($param['name']) {
			
		} else {
			$param['name'] = 'uploading_file';
		}
		
		$res_arr = array(
			'uploaded' => 0,
			'basename' => date('His', $this->Azbn7->created_at) . '_' . $this->Azbn7->hash($this->Azbn7->randstr(16, true), $this->event_prefix, $param['name']),
			'extension' => end(explode('.', $_FILES[$param['name']]['name'])),
			'title' => $this->Azbn7->c_s($_FILES[$param['name']]['name']),
			//'size' => $_FILES[$param['name']]['size'],
		);
		
		$res_arr['suffix'] = '.' . $res_arr['extension'];
		if($this->mime_type[$res_arr['extension']]) {
			$res_arr['mime_type'] = $this->mime_type[$res_arr['extension']];
		} else {
			$res_arr['mime_type'] = 'application/octet-stream';
		}
		
		$this->makePath($path . $res_arr['basename']);
		
		$res_arr['fullname'] = $path . $res_arr['basename'] . '/original' . $res_arr['suffix'];
		
		if (move_uploaded_file($_FILES[$param['name']]['tmp_name'], $res_arr['fullname'])) {
			
			/*
			name, size, type, tmp_name, error
			*/
			
			$res_arr['uploaded'] = 1;
			$res_arr['size'] = $_FILES[$param['name']]['size']; 
			
			$this->uploaded++;
			
			$this->Azbn7->event(array(
				'action' => $this->event_prefix . '.save',
				'title' => $res_arr['fullname'],
			));
			
		}
		
		return $res_arr;
		
	}
	
	public function from_dataurl($param = array())
	{
		
		$path = $this->path;
		
		if($param['path']) {
			$path = $path . $param['path'] . '/';
		}
		
		$path = $path . date('Y/m/d') . '/';
		
		$this->makePath($path);
		
		if($param['name']) {
			
		} else {
			$param['name'] = 'uploading_file';
		}
		
		$res_arr = array(
			'uploaded' => 0,
			'basename' => date('His', $this->Azbn7->created_at) . '_' . $this->Azbn7->hash($this->Azbn7->randstr(16, true), $this->event_prefix, $param['name']),
			'extension' => 'png',
			'title' => 'Uploaded image ' . date('d.m.Y H:i'),
			//'size' => $_FILES[$param['name']]['size'],
		);
		
		$res_arr['suffix'] = '.' . $res_arr['extension'];
		if($this->mime_type[$res_arr['extension']]) {
			$res_arr['mime_type'] = $this->mime_type[$res_arr['extension']];
		} else {
			$res_arr['mime_type'] = 'application/octet-stream';
		}
		
		$this->makePath($path . $res_arr['basename']);
		
		$res_arr['fullname'] = $path . $res_arr['basename'] . '/original' . $res_arr['suffix'];
		
		$pic = explode(',',$_POST[$param['name']]);
		$pic = str_replace(' ', '+', $pic[1]);
		$pic = base64_decode($pic);
		
		$file = fopen($res_arr['fullname'], 'w');
		fwrite($file, $pic);
		fclose($file);
		
		$res_arr['uploaded'] = 1;
		
		$this->uploaded++;
		
		$this->Azbn7->event(array(
			'action' => $this->event_prefix . '.save',
			'title' => $res_arr['fullname'],
		));
		
		return $res_arr;
		
	}
	
}