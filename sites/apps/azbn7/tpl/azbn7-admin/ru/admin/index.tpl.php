<?
// Административный шаблон
?>

<?=isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : '';?>
<?=$_SERVER['SERVER_NAME'];?>

<!--<h2 class="mt-2 mb-1" >CMS Azbn7. Управление сайтом</h2>-->

<?
/*
$this->Azbn7->mdl('Viewer')->tpl('_/editor/gallery-collect', array(
	'title' => 'Прикрепленные изображения',
	'html' => ' id="" ',
	'name' => 'item[images]',
	'value' => '[5,7,8,10]',
	'type' => '4',
	//'single' => 1,
	//'path' => 'entity',
));
*/
?>

<?
/*
$this->Azbn7->mdl('Viewer')->tpl('_/editor/yandex-maps-editor-point', array(
	'title' => 'Область на карте',
	'html' => ' id="" ',
	'name' => 'item[point]',
	'value' => '',
	//'type' => '4',
	//'single' => 1,
	//'path' => 'entity',
));
*/
?>

<?
/*
$this->Azbn7->mdl('Viewer')->tpl('_/editor/yandex-maps-editor-area', array(
	'title' => 'Область на карте',
	'html' => ' id="" ',
	'name' => 'item[area]',
	'value' => '',
	//'type' => '4',
	//'single' => 1,
	//'path' => 'entity',
));
*/
?>