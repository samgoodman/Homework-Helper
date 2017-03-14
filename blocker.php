<?php
	$email=$_GET["email"];
	$homework=$_GET["homework"];
	$class=$_GET["class"];
	$department=$_GET["department"];


	$servername = "localhost";
	$username = "root";
	$password = "outg0anAtk";
	$dbname = "homework";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = $conn->prepare("UPDATE WantsHelpWith SET blockEmails=TRUE WHERE student_email=? and homework_number=? and class_number=? and department=?");
	$sql->bind_param("siis", $email, $homework, $class, $department);
	if($sql->execute()){
		echo "You will no longer get emails for this homework. Have a nice day!";
	}

?>