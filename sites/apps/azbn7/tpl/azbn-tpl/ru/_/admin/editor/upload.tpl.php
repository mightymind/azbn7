<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<div class="input-group " >
		<input type="text" class="form-control" name="<?=$param['name'];?>" value="<?=$param['value'];?>" />
		<span class="input-group-btn">
			<button class="btn btn-secondary" type="button">+</button>
		</span>
	</div>
</div>