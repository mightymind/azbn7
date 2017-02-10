<?
// Административный шаблон
?>


<h1 class="mt-2 mb-1" >CMS Azbn7. Документация</h1>
<hr />







<div id="doc" role="tablist" aria-multiselectable="true">
	
	<div class="card" id="doc-0" >
		<div class="card-header" role="tab" id="doc-0-h">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordion" href="#doc-0-c" aria-expanded="true" aria-controls="doc-0-c">
					CMS Azbn7. Точка входа, структура папок
				</a>
			</h5>
		</div>
		
		<div id="doc-0-c" class="collapse show" role="tabpanel" aria-labelledby="doc-0-h">
			<div class="card-block">
				
				<p>Работа CMS Azbn7 начинается с файла index.php - в нем подключается конфиг из папки sites/config, вызывается и создается объект $Azbn7. В этот объект передается конфиг, после чего подключаются нужные модули и расширения.</p>
				<p>По умолчанию класс \azbn7\Azbn7 находится в файле system/azbn7/azbn7.class.php</p>
				<p>Основные системные файлы находятся в папке system/azbn7. Не рекомендуется их менять. В папке system/vendor находятся подключаемые библотеки других разработчиков.</p>
				<p>Программные части сайтов находятся в папке sites. В sites/config лежат конфиги, а в sites/apps - сами скрипты. </p>
				
			</div>
		</div>
	</div>
	
	
	
	
	<div class="card" id="doc-1" >
		<div class="card-header" role="tab" id="doc-1-h">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordion" href="#doc-1-c" aria-expanded="true" aria-controls="doc-1-c">
					Фреймворк Azbn7. Класс \azbn7\Azbn7
				</a>
			</h5>
		</div>
		
		<div id="doc-1-c" class="collapse show" role="tabpanel" aria-labelledby="doc-1-h">
			<div class="card-block">
				
				<p>Фреймворк Azbn7 построен на базе фреймворка ForEach, который признан безнадежно устаревшим, но имевшим простую и логичную структуру и большие возможности для использования.</p>
				<p>В основе фреймворка лежит класс \azbn7\Azbn7, который предоставляет базовые функции для работы всей системы.</p>
				
				<hr />
				
				<p>Функции \azbn7\Azbn7</p>
				
				<ul>
					<?
					$texts = array(
						array(
							'title' => "__construct(\$config = array())",
							'preview' => "Вызывается при создании объекта класса. В ней происходит инициалиция основных переменных, назначаются обработчики ошибок и исключений. В качестве параметра передается ассоциативный массив",
						),
						array(
							'title' => "__destruct()",
							'preview' => "Вызывается при удалении объекта. По-умолчанию ничего не делает",
						),
						array(
							'title' => "echo_dev(\$str = '', \$src = '')",
							'preview' => "Если скрипт работает в окружении разработки (отладки), выводит переданное сообщение \$str, дополняя его информацией, откуда оно исходит (\$src)",
						),
						array(
							'title' => "getTiming(\$m = 0)",
							'preview' => "Вычисляет время (мс), прешедшее с начала инициализации \azbn7\Azbn7. Может использоваться для отладки. Если параметр \$m равен 0, то берется за основу текущий момент, если нет - то переданный. Время берется в UTC-секундах с учетом миллисекунд.",
						),
						array(
							'title' => "event(\$arr)",
							'preview' => "Используется для отладки. Сохраняет в память данные по переданному событию или ошибке.",
						),
						array(
							'title' => "onError(\$errno, \$errstr, \$errfile, \$errline)",
							'preview' => "Функция обработки ошибок",
						),
						array(
							'title' => "onException(\$e)",
							'preview' => "Функция обработки исключений",
						),
						array(
							'title' => "load(\$arr)",
							'preview' => "Загрузка модуля по переданным параметрам",
						),
						array(
							'title' => "mdl(\$uid)",
							'preview' => "Доступ к подключенному модулю по его uid",
						),
						array(
							'title' => "is_mdl(\$uid)",
							'preview' => "Функция проверки существования модуля",
						),
						array(
							'title' => "run(\$dir, \$file, &\$param)",
							'preview' => "Запуск кода из файла \$file. Обычно используется для обработки запросов к сайту",
						),
						array(
							'title' => "hash(\$str, \$salt1 = '', \$salt2 = '')",
							'preview' => "Вычисление хеша строки. Два доп.параметра - \"соль\" для хеширования",
						),
						array(
							'title' => "as_int(\$value = 0)",
							'preview' => "Возвращает переданный параметр в качестве целого числа",
						),
						array(
							'title' => "as_num(\$value = 0)",
							'preview' => "Возвращает переданный параметр в качестве числа",
						),
						array(
							'title' => "is_num(\$value = 0)",
							'preview' => "Проверяет, является ли параметр числом",
						),
						array(
							'title' => "as_html(\$value = '')",
							'preview' => "Возвращает переданный параметр в качестве HTML-кода",
						),
						array(
							'title' => "as_url(\$value = '')",
							'preview' => "Возвращает переданный параметр в качестве URL-адреса",
						),
						array(
							'title' => "c_s(\$value = '')",
							'preview' => "Возвращает переданный параметр отфильтрованным",
						),
						array(
							'title' => "c_email(\$value = '')",
							'preview' => "Возвращает переданный параметр в качестве E-mail",
						),
						array(
							'title' => "go2(\$url = '/')",
							'preview' => "Делает 301 редирект на \$url",
						),
						array(
							'title' => "mail2(\$to, \$from, \$subject, \$body, \$headers=array())",
							'preview' => "Отправляет письмо",
						),
						array(
							'title' => "is_email(\$email = '')",
							'preview' => "Проверка на валидность E-mail",
						),
						array(
							'title' => "get_utc(\$year = 0, \$month = 0, \$day = 0, \$hour = 0, \$min = 0, \$sec = 0)",
							'preview' => "Возвращащет UTC для нужного момента",
						),
						array(
							'title' => "get_formdate(\$tpl = 'YmdHis', \$year = 0, \$month = 0, \$day = 0, \$hour = 0, \$min = 0, \$sec = 0)",
							'preview' => "Возвращает отформатированное время",
						),
						array(
							'title' => "get_date(\$utc)",
							'preview' => "Возвращает массив с данными по времени для момента \$utc в UTC",
						),
						array(
							'title' => "w2f(\$file, \$str = '')",
							'preview' => "Быстрая запись в файл",
						),
						array(
							'title' => "getMicroTime()",
							'preview' => "Возвращает UTC с миллисекундами",
						),
						array(
							'title' => "randstr(\$len, \$sym = false)",
							'preview' => "Генерирует случайную строку длиной \$len. \$sym - использовать ли небуквенные символы",
						),
						array(
							'title' => "ru2en(\$str = '')",
							'preview' => "Простая функция транслита",
						),
						array(
							'title' => "getJSON_prepareUTF(\$matches)",
							'preview' => "Внутренняя служебная функция. Используется в трансляции в JSON",
						),
						array(
							'title' => "getJSON(\$_a = array())",
							'preview' => "Получает JSON от переданного объекта",
						),
						array(
							'title' => "parseJSON(\$j)",
							'preview' => "Парсит JSON и возвращает объект из него",
						),
						array(
							'title' => "wget(\$url = '', \$p = array())",
							'preview' => "Получает подержимое $url",
						),
					);
					
					foreach($texts as $i => $t) {
						?>
					<li>
						<a class="btn btn-link" data-toggle="collapse" href="#doc-1-f-p-<?=$i;?>" aria-expanded="false" aria-controls="doc-1-f-p-<?=$i;?>" ><?=$t['title'];?></a>
						<div class="collapse" id="doc-1-f-p-<?=$i;?>">
							<p><?=$t['preview'];?></p>
						</div>
					</li>
						<?
					}
					
					?>
				</ul>
				
			</div>
		</div>
	</div>
	
	<!--
	<div class="card" id="doc-2" >
		<div class="card-header" role="tab" id="doc-2-h">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordion" href="#doc-2-c" aria-expanded="true" aria-controls="doc-2-c">
					
				</a>
			</h5>
		</div>
		
		<div id="doc-2-c" class="collapse show" role="tabpanel" aria-labelledby="doc-2-h">
			<div class="card-block">
				
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	<div class="card" id="doc-0" >
		<div class="card-header" role="tab" id="doc-0-h">
			<h5 class="mb-0">
				<a data-toggle="collapse" data-parent="#accordion" href="#doc-0-c" aria-expanded="true" aria-controls="doc-0-c">
					
				</a>
			</h5>
		</div>
		
		<div id="doc-0-c" class="collapse show" role="tabpanel" aria-labelledby="doc-0-h">
			<div class="card-block">
				
			</div>
		</div>
	</div>
	-->
	
	
	
</div>
