<?
/*
$entity = $param['entity'];

var_dump($entity);

$entity2 = $this->Azbn7->mdl('Entity')->item($entity['entity']['id']);

var_dump($entity2);
*/

switch(intval($param['entity']['type']['id'])) {
	
	case 1 : {
		
		$this->Azbn7->mdl('Site')
			->render('entity/by_type/page', $param)
		;
		
	}
	break;
	
	case 2 : {
		
		$this->Azbn7->mdl('Site')
			->render('entity/by_type/category', $param)
		;
		
	}
	break;
	
	case 3 :
	case 4 :
	case 5 :
	case 6 :
	case 7 : {
		
		$this->Azbn7->go2($this->Azbn7->mdl('Site')->url($param['entity']['item']['path']));
		
	}
	break;
	
	default : {
		echo 'Это не страница!';
	}
	break;
	
}
