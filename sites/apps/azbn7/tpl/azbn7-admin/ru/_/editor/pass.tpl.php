<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<input type="text" class="form-control" name="<?=$param['name'];?>" value='' <?if(isset($param['input_html'])){echo $param['input_html'];}?> placeholder="Введите новый пароль, если необходимо его сменить" />
</div>