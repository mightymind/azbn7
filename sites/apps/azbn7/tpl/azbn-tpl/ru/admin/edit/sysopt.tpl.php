<?
// Административный шаблон
?>

<form action="/admin/update/sysopt/" method="POST" >
	
	<input type="hidden" name="item[id]" value="<?=$param['item']['id'];?>" />
	
	<div>
		<?=$param['item']['uid'];?>
	</div>
	
	<div>
		<input type="text" name="item[data][title]" value="<?=$param['item']['title'];?>" placeholder="Название (пояснение)" />
	</div>
	
	<div>
		Формат <select name="item[json]" data-select-value="<?=$param['item']['json'];?>" >
			<option value="0" >любой</option>
			<option value="1" >JSON</option>
		</select>
	</div>
	
	<div>
		Возможность редактирования <select name="item[editable]" data-select-value="<?=$param['item']['editable'];?>" >
			<option value="0" >нет, параметр нельзя редактировать</option>
			<option value="1" >да, параметр можно редактировать</option>
		</select>
	</div>
	
	<div>
		<input type="text" name="item[value]" value="<?=$param['item']['value'];?>" placeholder="Значение" />
	</div>
	
	<div>
		<input type="submit" value="Обновить" />
	</div>
	
</form>