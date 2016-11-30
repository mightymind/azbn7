<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<select class="form-control" name="<?=$param['name'];?>" data-select-value="<?=$param['value'];?>" >
		<option value="0" >любой</option>
		<option value="1" >JSON</option>
	</select>
</div>