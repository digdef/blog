<?php

$config = array(
	'title'=>'chlen 50 sm',
	'bd'=>array(
		'server'=>'localhost',
		'username'=>'root',
		'password'=>'',
		'name'=>'blog'
	)
);

$connection = mysqli_connect(
	$config['bd']['server'],
	$config['bd']['username'],
	$config['bd']['password'],
	$config['bd']['name']
);

if ($connection == false) {
	echo 'БД нет, пошел на хер!!!<br>';
	echo mysqli_connect_error();
	exit();
}