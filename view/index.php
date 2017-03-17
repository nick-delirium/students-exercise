<?php include_once ROOT.'/view/layout/header.php';?>

<div>
	Students List	<br>
Search: <form action="#" method="post" style='width: 300px;'>
	<input type='text' name='search' value='' placeholder="Имя, фамилия или группа" style='width: 200px;'><br>
	<input type='submit' name='submit' value="search">
	</form>
</div>

<div>
	<table>
		<tr>
			<td>name</td>
			<td>group</td>
			<td>points</td>
		</tr>
		<?php foreach($students as $student): ?>
		<tr>
			<td><?= $student['first_name'].' '.$student['last_name'];?> </td>
			<td><?= $student['groupNum'];?> </td>
			<td><?= $student['points'];?> </td>
		</tr>
		<?php endforeach;?>
	</table>
<a href='/profile/'>Войти в свой профиль.</a>
</div>
</body>
