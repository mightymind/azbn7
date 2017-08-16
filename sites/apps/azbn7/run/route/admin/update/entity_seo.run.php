<?

if(count($_POST['item'])) {
	
	$item_id = $this->Azbn7->as_num($_POST['item']['entity']);
	
	$item = array(
		'entity' => $item_id,
		'title' => $this->Azbn7->c_s($_POST['item']['title']),
		'description' => $this->Azbn7->c_s($_POST['item']['description']),
		'keywords' => $this->Azbn7->c_s($_POST['item']['keywords']),
	);
	
	$seo = $this->Azbn7->mdl('DB')->one('entity_seo', "entity = '{$item_id}'");
	
	if($seo['id']) {
		
		$this->Azbn7->mdl('DB')->update('entity_seo', $item, "entity = '$item_id'");
		
	} else {
		
		$this->Azbn7->mdl('DB')->create('entity_seo', $item);
		
	}
	
	$this->Azbn7->go2($this->Azbn7->mdl('Site')->url('/admin/edit/entity_seo/' . $item_id . '/'));
	
}
