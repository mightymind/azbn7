<?
// виджет

//$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

//$this->Azbn7->as_num($param['single']);

?>

<script type="text/javascript">

(function(){
	
	var myMap;
	var myPoint;
	
	ymaps.ready(yandex_map_init_<?=$tpl_uid;?>);
	
	function yandex_map_init_<?=$tpl_uid;?>() {
		
		var genPoint = function(coord, data) {
			
			return new ymaps.GeoObject({
				geometry: {
					type: 'Point',
					coordinates: coord,
					},
				properties: {
					iconContent: data.title,
					hintContent: data.preview,
					}
				}, {
					preset: 'islands#blackStretchyIcon',
					//draggable: true,
				}
			);
			
		};
		
		myMap = new ymaps.Map('yandex-map-container-<?=$tpl_uid;?>', {
			center : [52.967187, 36.069613],
			zoom : 12,
			controls : ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl'],//'default', 'smallMapDefaultSet', 'largeMapDefaultSet'
		}, {
			searchControlProvider : 'yandex#search',
		});
		
		myPoint = genPoint([<?=($param['value'] == '' ? '' : $param['value']);?>], {title : 'Название', preview : 'Описание',});
		
		myMap.events.add('click', function(e) {
			if (!myMap.balloon.isOpen()) {
				
				var coords = e.get('coords');
				
				myMap.balloon.open(coords, {
					contentHeader: 'Новая отметка',
					contentBody: '<p>Координаты щелчка: ' + [coords[0].toPrecision(8), coords[1].toPrecision(8)].join(', ') + '</p>',
					//contentFooter:'<sup>Щелкните еще раз</sup>',
				});
				
				myMap.geoObjects.remove(myPoint);
				
				myPoint = genPoint([coords[0].toPrecision(8), coords[1].toPrecision(8)], {title : 'Название', preview : 'Описание',});
				
				myMap.geoObjects.add(myPoint);
				
				$('#yandex-map-value-<?=$tpl_uid;?>').val([coords[0].toPrecision(8), coords[1].toPrecision(8)].join(', '));
				
			} else {
				
				myMap.balloon.close();
				
			}
		
		});
		
		myMap.geoObjects.add(myPoint);
		
	}
	
	// изменение размера карты
	// myMap.container.fitToViewport();
	
	// Деструктор карты
	// myMap.destroy();
	// myMap = null;
	
})();

</script>


<div class="form-group yandex-maps-editor " <?=$param['html'];?> >
	
	<label>
		<?=$param['title'];?>
	</label>
	
	<div class="yandex-map-container" id="yandex-map-container-<?=$tpl_uid;?>" ></div>
	
	<textarea class="azbn7-hidden edit-value " name="<?=$param['name'];?>" id="yandex-map-value-<?=$tpl_uid;?>" ><?=($param['value'] == '' ? '[]' : $param['value']);?></textarea>
	
</div>