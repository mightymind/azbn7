<?
// виджет
?>

<div class="form-group alert alert-warning " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<select class="form-control" name="<?=$param['name'];?>" data-select-value="<?=$param['value'];?>" >
		<option value="0" >нет, элемент не используется</option>
		<option value="1" >да, элемент используется</option>
	</select>
</div>