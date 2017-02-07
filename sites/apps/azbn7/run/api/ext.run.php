<?
/*
обработчик API расширений
*/


$this->Azbn7
	->mdl('Ext')
		->event(strtolower($this->Azbn7->mdl('Req')->_post('event')), $param)
;

/*
var_dump($this->Azbn7
	->mdl('Ext')
		->__listeners
);die();
*/

//$param['meta']['msg']['text'] = $this->Azbn7->mdl('Req')->_post('event');