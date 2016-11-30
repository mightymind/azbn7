<?
// виджет
?>

<div class="form-group " <?=$param['html'];?> >
	<label><?=$param['title'];?> <span class="item-pos-view" >0</span></label>
	<input type="range" class="form-control item-pos-range " name="<?=$param['name'];?>" value="<?=$param['value'];?>" min="0" max="<?=$this->Azbn7->config['mysql'][0]['max_value']['js_int'];?>" step="1" />
</div>