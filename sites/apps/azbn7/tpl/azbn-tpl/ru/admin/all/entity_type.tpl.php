<?
// Административный шаблон
?>

<?
$entity_type = $this->Azbn7->mdl('DB')->read('entity_type');
$entity_type_h = $this->Azbn7->mdl('Site')->buildHierarchy($entity_type);

$this->Azbn7->mdl('Viewer')->tpl('_/hierarchy/list', array(
	'html' => 'class="" id=""',
	'hierarchy' => $entity_type_h,
	'start_index' => 0,
));
?>
