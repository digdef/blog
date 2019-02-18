<?php
require"includes/config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>digDef</title>
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
</head>
<body>
	<div id="sidebar">
		<ul>
			<li>Меню</li>
			<input class="btn2" type="button" onclick="setCookie('color_of_style', 'css/main.css', 365); document.getElementById('changeable_styles').href = 'css/main.css';" value="Тёмная тема"><br>
			<input class="btn2" type="button" onclick="setCookie('color_of_style', 'css/light.css', 365); document.getElementById('changeable_styles').href = 'css/light.css';" value="Светлая тема">
		</ul>
	</div>

	<?php include "includes/header/article-header.php" ?>

	<?php
		$article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = ".(int) $_GET['id']);
		if (mysqli_num_rows($article) <= 0) {
	?>	
	<div id="article-main">
		<div class="article-intro">
			<h2>Статья не найдена !!!</h2>
			<img style="max-width: 60%; max-height: 60%;" src="img/not.png">
		</div>
	</div>
	<?php
		}
		else{
			$art = mysqli_fetch_assoc($article);
	?>
			<div id="article-main">
				<div class="article-intro">
					<h2><?php echo $art['title']; ?></h2>
				</div>
				<div class="article-text">
					<img id="article_img" src="img/<?php echo $art['img'];?>"><br>
					<span><br>
						<?php echo $art['text']; ?> 
					</span>
				</div>
			</div>
	<?php
		}
	?>

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
		std = 'css/main.css'; // стандартные стили 
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