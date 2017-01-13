<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Настройки профиля</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/profile/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Логин',
		'html' => ' id="" ',
		'name' => 'item[login]',
		'value' => $param['item']['login'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/email', array(
		'title' => 'Email',
		'html' => ' id="" ',
		'name' => 'item[email]',
		'value' => $param['item']['email'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/pass', array(
		'title' => 'Пароль',
		'html' => ' id="" ',
		'name' => 'item[pass]',
		'value' => $param['item']['pass'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Тема оформления',
		'html' => ' id="" ',
		'name' => 'item[param][theme]',
		'value' => $param['item']['param']['theme'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Язык',
		'html' => ' id="" ',
		'name' => 'item[param][lang]',
		'value' => $param['item']['param']['lang'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/input', array(
		'title' => 'Редактор по-умолчанию',
		'html' => ' id="" ',
		'name' => 'item[param][wysiwyg]',
		'value' => $param['item']['param']['wysiwyg'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/rights', array(
		'item' => $param['item'],
		'type' => 'profile',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/submit', array(
		'title' => 'Обновить',
		'html' => '',
		//'name' => 'item[value]',
		//'value' => '',
		//'path' => 'entity',
	));
	?>
	
</form>