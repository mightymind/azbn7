<?
// виджет

//$tpl_uid

?>

<script>
$(function(){
	
	CKEDITOR.replace('azbn7-ckeditor-<?=$tpl_uid;?>', {
		allowedContent:true,
		filebrowserUploadUrl: '<?=$this->Azbn7->mdl('Site')->url('/admin/upload/wysiwyg/');?>',
	});
	
});
</script>

<div class="form-group" <?=$param['html'];?> >
	<label><?=$param['title'];?></label>
	<textarea id="azbn7-ckeditor-<?=$tpl_uid;?>" name="<?=$param['name'];?>" class="form-control azbn7-ckeditor" ><?=$param['value'];?></textarea>
</div>
