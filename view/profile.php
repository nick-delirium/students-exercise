<?php require_once(ROOT.'/view/layout/header.php');?>
<br/>
<p>Привет, <?= $student['first_name'];?>!</p>

<form action="#" method="post" class='form'>
Твое имя: <input type='text' name='fname' value="<?= $student['first_name'];?>"><br/>
  Фамилия: <input type='text' name='lname' value="<?= $student['last_name'];?>"><br/>
Группа: <input type='text' name='group' value="<?= $student['groupNum'];?>"><br/>
<input type="submit" name="submit" value="Изменить?">
</form>
Твои баллы <?= $student['points'];?>.

<hr>
Список одногруппников:
<ul>
<?php foreach($costudents as $costudent):?>
<li><?= $costudent['first_name'].' '.$costudent['last_name'];?>, <?= $costudent['points'];?> баллов</li>
<?php endforeach;?>
</ul>

<a href='/'>На главную</a>
