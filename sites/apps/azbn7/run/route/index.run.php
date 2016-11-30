<?

$param['entity'] = $this->Azbn7->mdl('Entity')->item(1);

$this->Azbn7->mdl('Site')
	->render('entity/by_type/page', $param)
;

echo $this->Azbn7->ch('<p class="default" >hello!</p>');