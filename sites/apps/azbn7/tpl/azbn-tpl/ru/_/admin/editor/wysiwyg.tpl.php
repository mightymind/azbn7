<?
// виджет

if($_SESSION['user']['param']['wysiwyg'] != '') {
	
	$editor = $_SESSION['user']['param']['wysiwyg'];
	
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/wysiwyg/' . $editor, $param);
	
} else {
	
	$this->Azbn7->mdl('Viewer')->tpl('_/admin/editor/textarea', $param);
	
}
