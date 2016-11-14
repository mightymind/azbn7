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
	
	<div class="field-list" >
		
		<div class="field-item" >
			<input type="" name="item[param][field][0][uid]" value="" placeholder="Название поля" />
			<input type="" name="item[param][field][0][type]" value="" placeholder="Тип поля (MySQL)" />
			<input type="" name="item[param][field][0][editor]" value="" placeholder="Редактировать через" />
		</div>
		
		<div class="btn-panel" >
			<a href="#add-field" class="add-btn" >+</a>
		</div>
		
	</div>
	
	<div>
		<input type="submit" value="Создать" />
	</div>
	
</form>

<script>
$(function(){
	
	$(document.body).on('azbn.reset', '.field-list .field-item', {}, function(event){
		event.preventDefault();
		
		var block = $(this);
		block.find('input').val('');
		
	});
	
	$(document.body).on('click', '.field-list .btn-panel .add-btn', {}, function(event){
		event.preventDefault();
		
		var block = $('.field-list');
		var last = block.find('.field-item').eq(-1);
		
		last.clone(true).insertAfter(last).trigger('azbn.reset');
		
	});
	
});
</script>