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
			$loggedstudent = new Student();
			$LoggedStudent = $loggedstudent->getOne($id);
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
			$student = new Student();
			$studentId = $student->checkStudent($name, $group);
			if ($studentId == false) $errors[] = "такого студента в группе $group не найдено.";
			else
			{
				$student->login($studentId[id], $name, $group);
				$LoggedStudent = $student->getOne($_SESSION['id']);
				header("Location: /profile/");
			}
		}
		require_once(ROOT.'/view/login.php');
	}
}
