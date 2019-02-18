<?php
include("config.php");
session_start();
include ("../lock.php");
?>
<head>
	<title>digDefAdmin</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
	<?php
	include("header.php");
	?>
	<div style="padding-top: 70px" id="delete">
		<?php

		$articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` ");

		$items = array();

		while ($art = mysqli_fetch_assoc($articles))
		{
		    $items[] = $art;
		}
		$items = array_reverse($items);

		for ($i = 0; $i < count($items); $i++) {
		    echo "<div style='height: 40px; border-radius: 10px; background-color: white; margin: 5px; overflow: hidden; border-style: solid; border-color: #bdc3c7; border-width: 0.7px; display: flex;'>";
		    echo "<div class='text' style='width: 33%; border-color: #bdc3c7; border-right-style: solid; border-right-width: 0.7px;'>" . $items[$i]["id"] . "</div>";
		    echo "<div class='text' style='width: 33%; border-color: #bdc3c7; border-right-style: solid; border-right-width: 0.7px; text-align: center'>" . $items[$i]["title"] . "</div>";
		    echo "<div class='text' style='padding: 0px;width: 33%; text-align: right'><button onclick='remove(\"".$items[$i]["id"]."\", \"".$items[$i]["title"]."\");' class=\"button-primary\" style=\"height: 30px; float: right; background-color: #e74c3c;\">Удалить</button></div>";
		    echo "</div>";
		}
		
		$id = $_GET['id'];

		if($id != ""){
		    $connection->query("DELETE FROM articles WHERE id = ".$id);
		}
		?>

	</div>
	<script>
		function remove(id, title){
			if(confirm("Удалить?"))
				$.get("delete.php?id=" + id + "&title=" + title, function(data){location.reload();});
		}
	</script>
</body>