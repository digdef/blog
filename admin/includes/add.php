<?php
include("config.php");
session_start();
include ("../lock.php");
?>
<head>
	<title>digDefAdmin</title>
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
	<?php
	include("header.php");
	?>
	<div style="padding-top: 70px" id="add">
		<form id="form_input" class="form" method="POST" action="add.php">
			<?php
			if (isset($_POST['do_post'])) {
				$errors = array();
				if ($_POST['title'] == '') {
					$errors[] = 'Введите Название!';
				}
				if ($_POST['img'] == '') {
					$errors[] = 'Введите Имя Превью!';
				}
				if ($_POST['text'] == '') {
					$errors[] = 'Введите Текст!';
				}
				
				if (empty($errors)) {
					echo '<span style="color: green;font-weight: bold;">Успех</span><br>';
					mysqli_query($connection, "INSERT INTO `articles` (`title`,`img`,`text`) VALUES ('".$_POST['title']."','".$_POST['img']."','".$_POST['text']."' )");
				}
				else{
					echo '<span style="color: red;font-weight: bold;">'.$errors['0'].'</span>';
				}
			}
			?>
			<label for="text">Название</label><br>
			<input type="text" placeholder="Введите Название" name="title" id="title"><br>
			<label >img(Название Картинка для главной страницы)</label><br>
			<input type="text" name="img" value="net.png"><br>	
			<label for="text">Текст</label><br>
			<button class="btn" id="alfa2" type="button" onClick="d1d(0)">Картинка</button>
			<button class="btn" id="alfa2" type="button" onClick="d1d(1)">Ссылка</button>
			<button class="btn" id="alfa2" type="button" onClick="d1d(2)">Новая строка</button>
			<button class="btn" id="alfa2" type="button" onClick="d1d(3)">Пропуск строки</button><br><br>

			<textarea id="text" name="text" placeholder="Введите текст"></textarea><br>			
			<input type="submit" name="do_post" id="mess_send" class="btn" value="Отправить"><br><br>
		</form>

		<form method="post" action="add.php" enctype="multipart/form-data" id="form_input"><br>
			<label for="name">Добавление картинок на сервер</label></p>
			<input type="file" id="inputfile" name="inputfile"><br>
			<input type="submit" value="Загрузить" class="btn" ><br>
		</form>
		<?php
		ini_set('upload_max_filesize', '2M'); 
		if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
			if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/jpeg'){
				$destiation_dir = dirname(__FILE__) . './../../img/' . $_FILES['inputfile']['name'];
				if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir)) {
					echo '<div style="padding: 100px;">Файл загрузился</div>';
				} else {
					echo '<div style="padding: 100px;">Файл не загрузился</div>';
				}
			}if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/png'){
				$destiation_dir = dirname(__FILE__) . './../../img/' . $_FILES['inputfile']['name'];
				if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir)) {
					echo '<div style="padding: 100px;">Файл загрузился</div>';
				} else {
					echo '<div style="padding: 100px;">Файл не загрузился</div>';
				}			
			} else {
				switch ($_FILES['inputfile']['error']) {
					case UPLOAD_ERR_FORM_SIZE:
					case UPLOAD_ERR_INI_SIZE:
					echo '<div style="padding: 100px;">Размер файла превышает</div>';
					break;
					case UPLOAD_ERR_NO_FILE:
					echo '<div style="padding: 100px;">Не выбрано</div>';
					break;
				}
			}
		}
		?>
	</div>
	<script>
		function d1d (x)
		{
		var txt = x ;
		if (x == 0) var txt = '<img  id="index_img"  src="img/НАЗВАНИЕ КАРТИНКИ" >  ';
		if (x == 1) var txt = '<a href="URL">...</a>  ';
		if (x == 2) var txt = '<br>';
		if (x == 3) var txt = '</p>';
		var langg = document.getElementById ('text'); 
		var nc = langg.selectionStart; 
		langg.value = langg.value.substr (0, nc) + txt + langg.value.substr (nc);
		}
	</script>
</body>