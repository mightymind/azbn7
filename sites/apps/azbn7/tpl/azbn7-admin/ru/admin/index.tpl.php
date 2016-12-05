<?
// Административный шаблон
?>


<!--<h2 class="mt-2 mb-1" >CMS Azbn7. Управление сайтом</h2>-->

<?
$this->Azbn7->mdl('Viewer')->tpl('_/editor/gallery-collect', array(
	'title' => 'Прикрепленные изображения',
	'html' => ' id="" ',
	'name' => 'item[images]',
	'value' => '[5]',
	'type' => '4',
	//'single' => 1,
	//'path' => 'entity',
));
?>