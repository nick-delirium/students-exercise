<?php


class Students
{
	public function getAll()
	{
		$db = Database::Connect();
		$students = [];
		$sql = "SELECT * FROM students";

		$result = $db->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);

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

		if (is_numeric($options['text'])) $options['type'] = 'group';
		elseif (is_string($options['text']) && $options['text'] != '') $options['type'] = 'name';
		elseif ($options['text'] == '') $options['type'] = '';


		if ($options['type'] == 'name')
		{
			$sql = "SELECT * FROM students WHERE first_name like :text OR last_name like :text";
			$result = $db->prepare($sql);
			$result->bindParam(":text", $options['text'], PDO::PARAM_STR);
			$result->execute();
		}
		elseif ($options['type'] == 'group')
		{
			$sql = "SELECT * FROM students WHERE groupNum = :groupNum";
			$result = $db->prepare($sql);
			$result->bindParam(":groupNum", $options['text'], PDO::PARAM_INT);
			$result->execute();
		}

		$result->setFetchMode(PDO::FETCH_ASSOC);

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

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		return $result->fetch();
	}

	public static function updateStudent($fname, $lname, $group, $id)
	{
		$db = Database::Connect();
		$sql = 'UPDATE students SET first_name=:first_name,last_name=:last_name,groupNum=:groupNum WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':first_name', $fname, PDO::PARAM_STR);
		$result->bindParam(':last_name', $lname, PDO::PARAM_STR);
		$result->bindParam(':groupNum', $group, PDO::PARAM_INT);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->execute();
	}

	public function getName($id)
	{
		$id = intval($id);
		$db = Database::Connect();
		$sql = 'SELECT * FROM students WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->execute();
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$student = $result->fetch();
		$name = $student['first_name'].' '.$student['last_name'];
		return $name;
	}

	public function findCostudents($group)
	{
		$costudents = [];
		$db = Database::Connect();
		$sql = 'SELECT * FROM students WHERE groupNum = :groupNum';

		$result = $db->prepare($sql);
		$result->bindParam(':groupNum', $group, PDO::PARAM_INT);
		$result->execute();

		for($i=0; $row = $result->fetch(); $i++) {
			$costudents[$i]['first_name'] = $row['first_name'];
			$costudents[$i]['last_name'] = $row['last_name'];
			$costudents[$i]['points'] = $row['points'];
		}
		return $costudents;
	}


	public function login($studentId, $name, $group)
	{
		$id = intval($studentId);
		if (!isset($_SESSION['id']))
		{
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['groupnum'] = $group;
		}
	}
}
