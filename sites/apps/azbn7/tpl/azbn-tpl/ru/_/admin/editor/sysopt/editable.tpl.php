<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<select class="form-control" name="<?=$param['name'];?>" data-select-value="<?=$param['value'];?>" >
		<option value="0" >нет, параметр нельзя редактировать</option>
		<option value="1" >да, параметр можно редактировать</option>
	</select>
</div>