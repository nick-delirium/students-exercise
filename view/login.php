<?php if($errors): ?>
<?php foreach($errors as $error): ?>
<?= $error;?>
<?php endforeach;?>
<?php endif;?>

<form action="#" method="post">
<input type="text" name='name' value="" placeholder="Ваша фамилия">
<input type="text" name='group' value="" placeholder="Ваша группа">
<input type="submit" name="submit" value='отправить'>
</form>