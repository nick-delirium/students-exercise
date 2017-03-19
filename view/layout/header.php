<!DOCTYPE html>
<head>
<meta charset="utf-8">
<link href='main.css' rel='stylesheet'>
</head>
<body>
<?php if(isset($_SESSION['id'])): ?>
	<span>Вошли как <?=$LoggedStudent['first_name'].' '.$LoggedStudent['last_name'];?>, <a href='/exit' class="log">Выйти?</a></span>
<?php else: ?>
	<a href='/login' class="log">Войти в свой профиль</a>
<?php endif;?>
