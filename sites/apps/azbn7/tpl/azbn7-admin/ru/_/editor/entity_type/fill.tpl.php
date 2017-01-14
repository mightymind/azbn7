<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<select class="form-control" name="<?=$param['name'];?>" data-select-value="<?=$param['value'];?>" >
		<option value="0" >нет, новые записи не создаются</option>
		<option value="1" >да, записи данного типа создаются</option>
	</select>
</div>