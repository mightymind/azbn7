<?
// виджет

$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

$finded = false;

if(is_array($entity['item'])) {
	$finded = true;
}

?>

<div class="form-group entity-select-block" <?=$param['html'];?> data-entity-id="<?=$param['value'];?>" >
	<label><?=$param['title'];?></label>
	<input type="hidden" class="entity-select-value" name="<?=$param['name'];?>" value="<?=$param['value'];?>" />
	
	<div class="card">
		<div class="card-block">
			<?
			if($finded) {
			?>
			<h4 class="card-title entity-select-edit-title"><?=$entity['item']['title'];?></h4>
			<?
			}
			?>
			<p class="card-text ">
				<?
				if($finded) {
				?>
				<span class="entity-select-edit-type" ><?=$entity['type']['uid'];?></span>
				<?
				}
				?>
				
				<a href="#edit" class="card-link float-xs-right entity-select-edit-btn" >Выбрать родителя</a>
			</p>
		</div>
	</div>
	
</div>