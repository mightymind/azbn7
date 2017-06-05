<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<input type="text" class="form-control" name="<?=$param['name'];?>" value='<?=$param['value'];?>' <?if(isset($param['input_html'])){echo $param['input_html'];}?> />
</div>