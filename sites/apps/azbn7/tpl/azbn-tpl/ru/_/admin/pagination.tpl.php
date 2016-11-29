<?
// уведомления

//$param['count'] = 256;
$page_num = $param['page'] + 1;

$type_str = '';
if($param['type']['id']) {
	$type_str = '&type=' . $param['type']['id'];
}

if(count($param['items'])) {
	if($param['count'] > count($param['items'])) {
	?>
	
	<nav aria-label="Page navigation">
		<ul class="pagination">
			
			<?
			$max_page = ceil($param['count'] / $this->Azbn7->config['pagination']['count']);
			for($i = 1; $i <= $max_page; $i++) {
			?>
			<li class="page-item <?if($page_num == $i){echo 'active';}?> "><a class="page-link" href="?page=<?=$i;?><?=$type_str;?>"><?=$i;?></a></li>
			<?
			}
			?>
			
			<!--
			<li class="page-item">
				<a class="page-link" href="#" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				</a>
			</li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">4</a></li>
			<li class="page-item"><a class="page-link" href="#">5</a></li>
			<li class="page-item">
				<a class="page-link" href="#" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				</a>
			</li>
			-->
		</ul>
	</nav>
	
	<?
	}
} else {
?>
	<div class="alert alert-danger text-xs-center " role="alert">
		<strong>Извините</strong>, записи, удовлетворяющие данным условиям, не найдены!
	</div>
<?
}