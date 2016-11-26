<?
// виджет

//$tpl_uid

?>

<div class="form-group" <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<textarea class="form-control azbn7-tinymce" id="<?=$param['name'] . '-' . $tpl_uid;?>" name="<?=$param['name'];?>" ><?=$param['value'];?></textarea>
</div>