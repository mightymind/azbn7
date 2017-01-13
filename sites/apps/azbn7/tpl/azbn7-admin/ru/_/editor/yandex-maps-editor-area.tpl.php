<?
// виджет

//$entity = $this->Azbn7->mdl('Entity')->item($param['value']);

//$this->Azbn7->as_num($param['single']);

?>

<script type="text/javascript">

(function(){
	
	var myMap;
	var myPolygon;
	
	ymaps.ready(yandex_map_init_<?=$tpl_uid;?>);
	
	function yandex_map_init_<?=$tpl_uid;?>() {
		
		myMap = new ymaps.Map('yandex-map-container-<?=$tpl_uid;?>', {
			center : [52.967187, 36.069613],
			zoom : 12,
			controls : ['zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl'],//'default', 'smallMapDefaultSet', 'largeMapDefaultSet'
		}, {
			searchControlProvider : 'yandex#search',
		});
		
		// Создаем многоугольник без вершин.
		myPolygon = new ymaps.Polygon(<?=($param['value'] == '' ? '[]' : $param['value']);?>, {}, {
			// Курсор в режиме добавления новых вершин.
			editorDrawingCursor : 'crosshair',
			// Максимально допустимое количество вершин.
			editorMaxPoints : 10240,
			// Цвет заливки.
			fillColor : 'rgba(0,0,0,0.25)',
			// Цвет обводки.
			strokeColor : 'rgba(255,0,0,0.75)',
			// Ширина обводки.
			strokeWidth : 2,
		});
		// Добавляем многоугольник на карту.
		myMap.geoObjects.add(myPolygon);
		
		// В режиме добавления новых вершин меняем цвет обводки многоугольника.
		var stateMonitor = new ymaps.Monitor(myPolygon.editor.state);
		stateMonitor.add('drawing', function (newValue) {
			myPolygon.options.set('strokeColor', newValue ? '#FF0000' : '#0000FF');
		});
		
		// Включаем режим редактирования с возможностью добавления новых вершин.
		myPolygon.editor.startDrawing();
		
		myPolygon.geometry.events.add('change', function () {
			//document.getElementById('result').innerHTML = myPolygon.geometry.getCoordinates();
			$('#yandex-map-value-<?=$tpl_uid;?>').val(JSON.stringify(myPolygon.geometry.getCoordinates()));
		});
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