<?php


class Student
{
	public function getAll()
	{
		$db = Database::Connect();
		$students = [];
		$sql = "SELECT * FROM students";
		$db->query("SET NAMES 'UTF8'");
		$result = $db->query($sql);
		$result->setFetchMode(\PDO::FETCH_ASSOC);

		for($i=0; $row = $result->fetch(); $i++)
		{	$students[$i]['id'] = $row['id'];
			$students[$i]['first_name'] = $row['first_name'];
			$students[$i]['last_name'] = $row['last_name'];
			$students[$i]['groupNum'] = $row['groupNum'];
			$students[$i]['points'] = $row['points'];
		}
		return $students;
	}


	public function search($options)
	{
		$db = Database::Connect();
		$db->query("SET NAMES 'UTF8'");
		$sql = 'SELECT * FROM students WHERE (first_name like :text OR last_name like :text) OR groupNum like :text';

		$result = $db->prepare($sql);
		$result->bindParam(':text', $options['text']);
		$result->execute();

		$result->setFetchMode(\PDO::FETCH_ASSOC);

		for($i=0; $row = $result->fetch(); $i++)
		{
			$students[$i]['id'] = $row['id'];
			$students[$i]['first_name'] = $row['first_name'];
			$students[$i]['last_name'] = $row['last_name'];
			$students[$i]['groupNum'] = $row['groupNum'];
			$students[$i]['points'] = $row['points'];
		}
		return $students;


	}

	public function getOne($id)
	{
		$id = intval($id);
		$db = Database::Connect();
		$sql = 'SELECT * FROM students WHERE id = :id';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
		$result->execute();
		$result->setFetchMode(\PDO::FETCH_ASSOC);
		return $result->fetch();
	}

	public static function updateStudent($fname, $lname, $group, $id)
	{
		$db = Database::Connect();
		$sql = 'UPDATE students SET first_name=:first_name,last_name=:last_name,groupNum=:groupNum WHERE id = :id';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':first_name', $fname, \PDO::PARAM_STR);
		$result->bindParam(':last_name', $lname, \PDO::PARAM_STR);
		$result->bindParam(':groupNum', $group, \PDO::PARAM_INT);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
		$result->execute();
	}

	public function checkStudent($name, $group)
	{
		$db = Database::Connect();
		$sql = 'SELECT id FROM students WHERE last_name like :name AND groupNum like :groupNum';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, \PDO::PARAM_STR);
		$result->bindParam(':groupNum', $group, \PDO::PARAM_INT);
		$result->execute();
		$result->setFetchMode(\PDO::FETCH_ASSOC);
		$id = $result->fetch();
		return $id;
	}

	public function findCostudents($group)
	{
		$costudents = [];
		$db = Database::Connect();
		$sql = 'SELECT * FROM students WHERE groupNum = :groupNum';
		$db->query("SET NAMES 'UTF8'");
		$result = $db->prepare($sql);
		$result->bindParam(':groupNum', $group, \PDO::PARAM_INT);
		$result->execute();

		for($i=0; $row = $result->fetch(); $i++) {
			$costudents[$i]['id'] = $row['id'];
			$costudents[$i]['first_name'] = $row['first_name'];
			$costudents[$i]['last_name'] = $row['last_name'];
			$costudents[$i]['points'] = $row['points'];
		}
		return $costudents;
	}


	public function login($studentId, $name, $group)
	{
		
		$id = intval($studentId);
		
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['groupnum'] = $group;
		
	}

	public function exit()
	{
		$_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
        }
        session_destroy();
	}
}
