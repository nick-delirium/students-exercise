<?php

namespace model;

class Student
{
	public function getAll()
	{
		$db = \components\Database::Connect();
		$students = [];
		$sql = "SELECT * FROM students";

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
		$db = \components\Database::Connect();

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
		$db = \components\Database::Connect();
		$sql = 'SELECT * FROM students WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
		$result->execute();
		$result->setFetchMode(\PDO::FETCH_ASSOC);
		return $result->fetch();
	}

	public static function updateStudent($fname, $lname, $group, $id)
	{
		$db = \components\Database::Connect();
		$sql = 'UPDATE students SET first_name=:first_name,last_name=:last_name,groupNum=:groupNum WHERE id = :id';

		$result = $db->prepare($sql);
		$result->bindParam(':first_name', $fname, \PDO::PARAM_STR);
		$result->bindParam(':last_name', $lname, \PDO::PARAM_STR);
		$result->bindParam(':groupNum', $group, \PDO::PARAM_INT);
		$result->bindParam(':id', $id, \PDO::PARAM_INT);
		$result->execute();
	}

	public function checkStudent($name, $group)
	{
		$db = \components\Database::Connect();
		$sql = 'SELECT id FROM students WHERE last_name like :name AND groupNum like :groupNum';

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, \PDO::PARAM_STR);
		$result->bindParam(':groupNum', $group, \PDO::PARAM_INT);
		$result->execute();
		return $result->fetch();
	}

	public function findCostudents($group)
	{
		$costudents = [];
		$db = \components\Database::Connect();
		$sql = 'SELECT * FROM students WHERE groupNum = :groupNum';

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
		if (!isset($_SESSION['id']))
		{
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['groupnum'] = $group;
		}
	}
}
