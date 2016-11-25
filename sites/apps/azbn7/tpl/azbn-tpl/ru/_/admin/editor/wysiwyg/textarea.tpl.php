<?
// виджет

//$tpl_uid

?>

<div class="form-group" <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<textarea class="form-control" id="<?=$param['name'] . '-' . $tpl_uid;?>" name="<?=$param['name'];?>" rows="5" ><?=$param['value'];?></textarea>
</div>