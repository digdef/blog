<?php
include("includes/config.php");
session_start();
include ("lock.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link rel="stylesheet" type="text/css" href="includes/css/main.css" id="changeable_styles"></link>
    <title>digDefAdmin</title>
</head>

<body>
<header>    
    <div id="logo" onclick="slowScroll('#top')">
        <span>digDef</span>
    </div>
    <div id="about">
        <a href="includes/add.php">Добавить</a>
        <a href="includes/delete.php">Удалить</a>
    </div>
</header>

</body>
</html>

