<?
// Административный шаблон
?>

<?
//echo $tpl_uid;
?>

<form action="/admin/create/entity_type/" method="POST" >
	
	<?
	$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
	$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

	$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/select', array(
		'html' => 'class="" id="" name="item[parent]"',
		'hierarchy' => $entity_type_h,
		'start_index' => 0,
	));
	?>
	
	<div>
		<input type="text" name="item[uid]" value="" placeholder="Уникальный ID" />
	</div>
	
	<div>
		<input type="text" name="item[title]" value="" placeholder="Название (пояснение)" />
	</div>
	
	<div class="" >
		
		<div class="" >
			<input type="" name="item[param][fields][0][uid]" value="" placeholder="Название поля" />
			<input type="" name="item[param][fields][0][type]" value="" placeholder="Тип поля (MySQL)" />
			<input type="" name="item[param][fields][0][editor]" value="" placeholder="Редактировать через" />
		</div>
		
	</div>
	
	<div>
		<input type="submit" value="Создать" />
	</div>
	
</form>