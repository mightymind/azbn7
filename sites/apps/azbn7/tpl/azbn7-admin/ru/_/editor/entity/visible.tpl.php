<?
// виджет
?>

<div class="form-group alert alert-warning " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<select class="form-control" name="<?=$param['name'];?>" data-select-value="<?=$param['value'];?>" >
		<option value="0" >элемент полностью скрыт</option>
		<option value="5" >элемент частично скрыт</option>
		<option value="10" >элемент отображается</option>
	</select>
</div>