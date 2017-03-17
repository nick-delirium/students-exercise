<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link href='main.css' rel='stylesheet'>
</head>
<body>
<?php if(isset($_SESSION['id'])): ?>
<?php
  $logged = new Students();
  $id = $_SESSION['id'];
  $name = $logged->getName($id);
?>
	<span>Вошли как <?=$name;?>, <a href='/exit' class="log">Выйти?</a></span>
<?php else: ?>
	<a href='/login' class="log">Войти в свой профиль</a>
<?php endif;?>
