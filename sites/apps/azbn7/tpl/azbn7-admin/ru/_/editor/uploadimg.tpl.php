<?
// виджет
?>

<div class="form-group single-upload-block " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<div class="input-group " >
		<input type="text" class="form-control upload-input" name="<?=$param['name'];?>" value='<?=$param['value'];?>' />
		<span class="input-group-btn">
			<button class="btn btn-primary upload-btn" type="button" ><i class="fa fa-upload" aria-hidden="true"></i></button>
		</span>
	</div>
	
	<div class="" >
		<img class="upload-viewer" src="<?=$param['value'];?>" />
	</div>
</div>