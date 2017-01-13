<?
// виджет

//$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

//$this->Azbn7->as_num($param['single']);

?>

<div class="form-group alert alert-warning gallery-collect " <?=$param['html'];?> data-type="<?=$this->Azbn7->as_num($param['type']);?>" >
	
	<label>
		<?=$param['title'];?>
	</label>
	
	<textarea class="azbn7-hidden edit-value " name="<?=$param['name'];?>" ><?=$param['value'];?></textarea>
	
	<div class="checked-list image-cont">
		
		<!--
		<a class="variant" draggable="true" href="#1" data-entity="1" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" ><i class="fa fa-times" aria-hidden="true"></i></a>
		<a class="variant" draggable="true" href="#1" data-entity="2" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" >2</a>
		<a class="variant" draggable="true" href="#1" data-entity="3" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" >3</a>
		<a class="variant" draggable="true" href="#1" data-entity="4" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" >4</a>
		<a class="variant" draggable="true" href="#1" data-entity="5" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" >5</a>
		<a class="variant" draggable="true" href="#1" data-entity="6" style="background-image:url(https://lh3.googleusercontent.com/-_qRK4aqaT-8/UUpxL_bV-yI/AAAAAAAAAAM/T3h5a2g20Js/s320/Full_HD_yeil_doa_manzaras.jpg);" >6</a>
		-->
		
		<a class="append-variant-item" href="#1" ><i class="fa fa-search-plus" aria-hidden="true"></i></a>
		<a class="upload-variant-item" href="#1" ><i class="fa fa-upload" aria-hidden="true"></i></a>
		
	</div>
	
	<div class="edit-block" >
		
		<label>Поиск среди загруженных изображений</label>
		
		<div class="edit-input" contenteditable="true" ></div>
		
		<div class="checked-list variant-cont"></div>
		
	</div>
	
</div>