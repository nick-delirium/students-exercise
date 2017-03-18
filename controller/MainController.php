<?php

class MainController
{
	public function actionIndex()
	{
		$Students = new Student();

	 	if (isset($_POST['submit']) && $_POST['search'] != '')
		{
			$options['type'] = '';
			$options['text'] = $_POST['search'];
		 	$students = $Students->search($options);
		}
	 	else $students = $Students->getAll();
	//  print_r($students);

		if(isset($_SESSION['id']))
		{
			$id = $_SESSION['id'];
			$student = new Student();
			$student = $student->getOne($id);
		}

		require_once(ROOT.'/view/index.php');
	}


	public function actionLogin()
	{
		$errors = false;
		if (isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$group = $_POST['group'];

			$studentId = Student::checkStudent($name, $group);
			if ($studentId == false) $errors[] = "такого студента в группе $group не найдено.";
			else
			{
				$students = new Student();
				$students->login($studentId, $name, $group);
				header("Location: /profile/");
			}
		}
		require_once(ROOT.'/view/login.php');
	}
}
