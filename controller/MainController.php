<?php

class MainController
{
	public function actionIndex()
	{
		$Students = new Students();

	 	if (isset($_POST['submit']) && $_POST['search'] != '')
		{
			$options['type'] = '';
			$options['text'] = $_POST['search'];
		 	$students = $Students->search($options);
		}
	 	else $students = $Students->getAll();
	//  print_r($students);

		require_once(ROOT.'/view/index.php');
	}


	public function actionLogin()
	{
		$errors = false;
		if (isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$group = $_POST['group'];


			$studentId = Students::checkStudent($name, $group);
			if ($studentId == false) $errors[] = "такого студента в группе $group не найдено.";
			else
			{
				$students = new Students();
				$students->login($studentId, $name, $group);
				header("Location: /profile/");
			}
		}
		require_once(ROOT.'/view/login.php');
	}
}
