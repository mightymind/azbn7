<?
// Административный шаблон
?>

<h2 class="mt-2 mb-1" >Настройки администратора</h2>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/update/user/');?>" method="POST" >
	
	<?
	$this->Azbn7->mdl('Viewer')->tpl('_/editor/hidden', array(
		//'title' => 'Идентификатор параметра',
		'html' => ' id="" ',
		'name' => 'item[id]',
		'value' => $param['item']['id'],
		//'path' => 'entity',
	));
	?>
	
	<div class="row" >
		
		<div class="col-md-4" >
			
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
				'title' => 'Ключ доступа к API',
				'html' => ' id="" ',
				'name' => 'item[key]',
				'value' => $param['item']['key'],
				//'path' => 'entity',
			));
			?>
			
		</div>
		
		<div class="col-md-4" >
			
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
				'title' => 'Тема оформления административного раздела',
				'html' => ' id="" ',
				'name' => 'item[param][theme_admin]',
				'value' => $param['item']['param']['theme_admin'],
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
				'input_html' => ' list="input-list-wysiwyg-0" ',
				'name' => 'item[param][wysiwyg]',
				'value' => $param['item']['param']['wysiwyg'],
				//'path' => 'entity',
			));
			?>
			
		</div>
		
		<div class="col-md-4" >
			
			<?
			$this->Azbn7->mdl('Viewer')->tpl('_/editor/rights', array(
				'item' => $param['item'],
				'type' => 'user',
			));
			?>
			
		</div>
		
	</div>
	
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