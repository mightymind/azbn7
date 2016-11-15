<?
// Административный шаблон
?>

<form action="<?=$this->Azbn7->mdl('Site')->url('/admin/create/sysopt/');?>" method="POST" >
	
	<div>
		<input type="text" name="item[uid]" value="" placeholder="Уникальный ID" />
	</div>
	
	<div>
		<input type="text" name="item[data][title]" value="" placeholder="Название (пояснение)" />
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
		<input type="text" name="item[value]" value="" placeholder="Значение" />
	</div>
	
	<div>
		<input type="submit" value="Создать" />
	</div>
	
</form>