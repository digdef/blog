<?php
require"includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>digDef</title>
	<?php require"includes/egg.php";?>
	<link rel="stylesheet" type="text/css" href="css/main.css" id="changeable_styles"></link>
	<script> 
		function setCookie(a,b,c){
			if(c){var d=new Date();
				d.setTime(d.getTime()+(c*24*60*60*1000));
				var e="; expires="+d.toGMTString()
			}
			else var e="";
			document.cookie=a+"="+b+e+"; path=/"
		};
		function getCookie(a)
		{
			var b=a+"=";
			var d=document.cookie.split(';');
			for(var i=0;i<d.length;i++)
				{
					var c=d[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);
					if(c.indexOf(b)==0)return c.substring(b.length,c.length)
				}
			return null
		};
		function eraseCookie(a){
			setCookie(a,"",-1)
		}; 
	</script>
</head>
<body>
	<div id="sidebar">
		<ul>
			<li>Меню</li>
			<input class="btn2" type="button" onclick="setCookie('color_of_style', 'css/main.css', 365); document.getElementById('changeable_styles').href = 'css/main.css';" value="Тёмная тема"><br>
			<input class="btn2" type="button" onclick="setCookie('color_of_style', 'css/light.css', 365); document.getElementById('changeable_styles').href = 'css/light.css';" value="Светлая тема">
		</ul>
	</div>

	<?php include "includes/header/header.php" ?>

	<div id="main">
		<?php
			$num = 4; 
			$page = 1;

			if ( isset($_GET['page']) ) {
				$page = (int) $_GET['page'];
			} 
			$result = mysqli_query($connection,"SELECT COUNT(`id`) AS `posts` FROM `articles`"); 
			$posts = mysqli_fetch_assoc($result);
			$posts = $posts['posts'];  
			$total = intval(($posts - 1) / $num) + 1;  
			$page = intval($page);  

			if(empty($page) or $page < 0) $page = 1;  
			  if($page > $total) $page = $total;  

			$start = $page * $num - $num;

			$articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $start, $num");

				while ($art = mysqli_fetch_assoc($articles))
			{
			?>
				<article style="display: inline-block;">
					<div class="intro">
		    			<h2><?php echo $art['title']; ?></h2>
						<img  id="index_img"  src="img/<?php echo $art['img'];?>" >
		    		</div>		    		
		    		<div class="text">
		    			<span>
		    				<?php echo mb_substr(strip_tags($art['text']), 0, 500, 'utf-8'); ?>... 
		    			</span><br><br>
		    			<div class="article">
		    				<a href="article.php?id=<?php echo $art['id'];?>">Подробнее</a>
		    			</div>
		    		</div>
		    	</article>
			<?php
			}
			?><div style="text-align: center;"> <?php

				if ($page != 1) $pervpage = '<a style="font-size: 25px;color: #515966;" href= ./index.php?page=1><<</a>  
				                               <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 1) .'>&#9668;</a> ';
				if ($page != $total) $nextpage = ' <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 1) .'>&#9658;</a>  
				                                   <a style="font-size: 25px;color: #515966;" href= ./index.php?page=' .$total. '>>></a>';  

				if($page - 2 > 0) $page2left = ' <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a>  ';  
				if($page - 1 > 0) $page1left = '<a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a>  ';  
				if($page + 2 <= $total) $page2right = '  <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';  
				if($page + 1 <= $total) $page1right = '  <a style="font-size: 25px;color: #515966;" href= ./index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
				?> 
				</div>
				<?php
				echo $pervpage.$page2left.$page1left.'<b style="font-size: 26px;color: #515966;">'.$page.'</b>'.$page1right.$page2right.$nextpage;
			?>
	</div>
	<div id="contacts">
		<center><h5>Обратная связь</h5></center>
		<form id="form_input">
			<label for="name">Имя</label><br>
			<input type="text" placeholder="Введите имя" name="name" id="name"><br>
			<label for="email">Ваша почта</label><br>
			<input type="email" placeholder="Введите email" name="email" id="email"><br>
			<label for="message">Сообщение</label><br>
			<textarea placeholder="Введите ваше сообщение" name="message" id="message"></textarea><br>
			<div id="mess_send" class="btn">Отправить</div>
		</form>
	</div>
	<?php include "includes/footer.php" ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

		function openMenu(){
			document.getElementById("sidebar").classList.toggle('active');
		}
		function slowScroll(id) {
			$('html, body').animate({
				scrollTop: $(id).offset().top
			}, 500);
		}
		+function() { 
		std = 'css/light.css'; 
		if(getCookie('color_of_style'))
			{
				var color=getCookie('color_of_style')
			}
			else{var color=std};
			document.getElementById('changeable_styles').href=color; 
		}();
	</script>
</body>
</html>