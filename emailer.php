<?php

$servername = "localhost";
$username = "root";
$password = "outg0anAtk";
$dbname = "homework";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $conn->prepare("SELECT * FROM EmailsToSend");
$sql->execute();
$sql->bind_result($target_email, $target_name, $classmate_name, $classmate_email, $classmate_phone, $department, $class_number, $homework_number);
while($sql->fetch()){
	email($target_email, $target_name, $classmate_name, $classmate_email, $classmate_phone, $department, $class_number, $homework_number);
}

$sql = $conn->prepare("TRUNCATE TABLE EmailsToSend");
$sql->execute();

$sql->close();
$conn->close();


function email($email, $name, $newName, $newEmail, $newPhone, $department, $class, $homework){
	require_once "Mail.php";

	$from = '<Homework.Helper.noreply@gmail.com>';
	$to = $email;
	$subject = 'A classmate is looking to collaborate!';
	$body = "Hey {$name}! One of your classmates in {$department} {$class} is also working on homework {$homework}, and they need help on the same problem as you! Their name is {$newName} and you can reach them at {$newEmail} {$newPhone}. If you want to stop receiving emails for this homework, follow this link: http://colab-sbx-425.oit.duke.edu/blocker.php?email={$email}&homework={$homework}&class={$class}&department={$department} . It may take up to 15 minutes to take effect.";

	$headers = array(
	    'From' => $from,
	    'To' => $to,
	    'Subject' => $subject
	);

	$smtp = Mail::factory('smtp', array(
	        'host' => 'ssl://smtp.gmail.com',
	        'port' => '465',
	        'auth' => true,
	        'username' => 'Homework.Helper.noreply@gmail.com',
	        'password' => 'outg0anAtk'
	    ));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
	    echo('<p>' . $mail->getMessage() . '</p>');
	}
}

?>

