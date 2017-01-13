<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Добавление профиля</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/profile/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Логин',
		'html' => ' id="" ',
		'name' => 'item[login]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/email', array(
		'title' => 'Email',
		'html' => ' id="" ',
		'name' => 'item[email]',
		'value' => '',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/pass', array(
		'title' => 'Пароль',
		'html' => ' id="" ',
		'name' => 'item[pass]',
		'value' => '',//$this->Azbn7->randstr(16),
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Тема оформления',
		'html' => ' id="" ',
		'name' => 'item[param][theme]',
		'value' => 'azbn-tpl/ru',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Язык',
		'html' => ' id="" ',
		'name' => 'item[param][lang]',
		'value' => 'ru',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Редактор по-умолчанию',
		'html' => ' id="" ',
		'name' => 'item[param][wysiwyg]',
		'value' => 'ckeditor',
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/rights', array(
		'item' => array('right' => array()),
		'type' => 'profile',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Создать',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>