<?php

class StudentController
{
	public function actionProfile()
	{
	 	$id = $_SESSION['id'];

		$student = new Student();
		$student = $student->getOne($id);

		$group = $student['groupNum'];
		$costudents = new Student();
		$costudents = $costudents->findCostudents($group);

		if (isset($_POST['submit']))
		{
			$id = $_SESSION['id'];
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$group = $_POST['group'];
			Student::UpdateStudent($fname, $lname, $group, $id);
			header("Location: /profile/");
		}
		require_once(ROOT.'/view/profile.php');
	}

	public function actionExit()
	{
		$_SESSION = [];
		if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
        }
        session_destroy();

        header("Location: /");
	}
}
