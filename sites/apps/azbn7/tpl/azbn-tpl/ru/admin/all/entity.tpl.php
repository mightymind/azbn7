<?
// Административный шаблон
?>

<?
if(count($param['items'])) {
	foreach($param['items'] as $e) {
		echo '<p>' . $e['type'] . ' : ' . $e['id'] . ' : ' . $e['url'] . '</p>';
	}
}
?>
