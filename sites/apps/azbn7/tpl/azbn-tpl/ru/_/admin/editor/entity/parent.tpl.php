<?
// виджет

$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

$finded = false;

if(is_array($entity['item'])) {
	$finded = true;
}

?>

<div class="form-group entity-select-block" <?=$param['html'];?> data-entity-id="<?=$param['value'];?>" data-single="<?=$this->Azbn7->as_int($param['single']);?>" >
	
	<label><?=$param['title'];?> <a href="#edit" class=" float-xs-right entity-select-edit-btn" >Изменить</a></label>
	
	<textarea class="azbn7-hidden entity-select-value " name="<?=$param['name'];?>" ><?=$param['value'];?></textarea>
	
	<div class="row entity-select-list" >
		
		<!--
		<div class="card col-sm-6 col-md-4">
			<div class="card-block">
				<p class="card-text ">
					<?
					if($finded) {
					?>
					<span class="entity-select-edit-type float-xs-right" ><?=$entity['type']['uid'];?></span>
					<?
					}
					?>
				</p>
				<?
				if($finded) {
				?>
				<h4 class="card-title entity-select-edit-title"><?=$entity['item']['title'];?></h4>
				<?
				}
				?>
			</div>
		</div>
		-->
		
	</div>
	
</div>