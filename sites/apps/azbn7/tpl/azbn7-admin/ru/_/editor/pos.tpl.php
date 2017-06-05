<?
// виджет
?>

<div class="form-group alert alert-warning item-pos-block" <?=$param['html'];?> >
	
	<div class="row" >
		
		<div class="col-md-12" >
			<label><?=$param['title'];?></label>
		</div>
		
		<div class="col-md-9" >
			<input type="range" class="form-control item-pos-range " value='<?=$param['value'];?>' min="0" max="<?=$this->Azbn7->config['mysql'][0]['max_value']['js_int'];?>" step="1" />
		</div>
		
		<div class="col-md-3" >
			<input type="number" class="form-control item-pos-view" name="<?=$param['name'];?>" value='<?=$param['value'];?>' min="0" max="<?=$this->Azbn7->config['mysql'][0]['max_value']['js_int'];?>" step="1" />
		</div>
		
	</div>
	
</div>