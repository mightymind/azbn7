<?
// Административный шаблон
?>

<form action="/admin/update/sysopt/<?=$param['item']['id'];?>/" method="POST" >
	
	<div>
		<input type="text" name="item[uid]" value="<?=$param['item']['uid'];?>" placeholder="Уникальный ID" />
	</div>
	
	<div>
		<input type="text" name="item_data[title]" value="<?=$param['item']['title'];?>" placeholder="Название (пояснение)" />
	</div>
	
	<div>
		Формат <select name="item[json]" >
			<option value="0" >любой</option>
			<option value="1" >JSON</option>
		</select>
	</div>
	
	<div>
		Возможность редактирования <select name="item[editable]" >
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