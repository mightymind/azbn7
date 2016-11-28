<?
// виджет

//$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

//$this->Azbn7->as_int($param['single']);

?>

<div class="form-group entity-autocomplete" <?=$param['html'];?> data-single="0" data-type="<?=$this->Azbn7->as_int($param['type']);?>" >
	
	<label><?=$param['title'];?></label>
	
	<textarea class="azbn7-hidden edit-value " name="<?=$param['name'];?>" >[1,2,3]</textarea>
	
	
	
	<div class="list-group checked-list">
		
	</div>
	
	<div class="edit-block" >
		
		<div class="edit-input" contenteditable="true" ></div>
		
		<div class="list-group variant-list"></div>
		
	</div>
	
</div>