<?
// виджет

//$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

//$this->Azbn7->as_int($param['single']);

?>

<div class="form-group entity-select-block" <?=$param['html'];?> data-single="1" data-type="<?=$this->Azbn7->as_int($param['type']);?>" >
	
	<label><?=$param['title'];?> <a href="#edit" class="btn btn-warning btn-sm float-xs-right entity-select-edit-btn" >Изменить</a></label>
	
	<textarea class="azbn7-hidden entity-select-value " name="<?=$param['name'];?>" ><?=$param['value'];?></textarea>
	
	<hr />
	
	<div class="row entity-select-list" ></div>
	
</div>