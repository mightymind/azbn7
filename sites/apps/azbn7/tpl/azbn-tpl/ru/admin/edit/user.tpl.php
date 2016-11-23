<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Настройки администратора</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/user/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/input', array(
		'title' => 'Логин',
		'html' => ' id="" ',
		'name' => 'item[login]',
		'value' => $param['item']['login'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/email', array(
		'title' => 'Email',
		'html' => ' id="" ',
		'name' => 'item[email]',
		'value' => $param['item']['email'],
		//'path' => 'entity',
	));
	?>
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/pass', array(
		'title' => 'Пароль',
		'html' => ' id="" ',
		'name' => 'item[pass]',
		'value' => $param['item']['pass'],
		//'path' => 'entity',
	));
	?>
	
	<button type="submit" class="btn btn-primary">Обновить</button>
	
</form>