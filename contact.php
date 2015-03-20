<?php

session_start();

require_once 'libs/phpmailer/PHPMailerAutoload.php';

$errors = []; // array literal depedning on php version or use $errors = array();

if(isset($_POST['name'], $_POST['email'], $_POST['message'])) {
	$fields = [
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'message' => $_POST['message']
	];

	foreach($fields as $field => $data) {
		if (empty($data)) {
			$errors[] = 'The ' . $field . ' field is required.';
		}
	}

	if(empty($errors)) {
		
		$m = new PHPMailer;

		$m->isSMTP();
		$m->SMTPAuth = true;

		// these details used to connnect to SMTP server
		$m->Host = 'smtp.gmail.com';
		$m->Username = 'dan.stachlewski@gmail.com';
		$m->Password = '12misty12';
		$m->SMTPSecure = 'ssl';
		$m->Port = 465;

		$m->Subject = 'Contact form Submitted';
		$m->Body = 'From: ' . $fields['name'] . '(' . $fields['email'] . ')\n' . $fields['message'] . ' ';

		//'From: ' . $fields['name'] . ' (' . $fields['email'] . ')<p>' . $fields['message'] . ' </p>';

		$m->FromName = 'Contact'; // Can be anything you want

		$m->AddReplyTo($fields['email'], $fields['name']);

		// address sending message to
		$m->AddAddress('dan.stachlewski@gmail.com', 'Dan Stachlewski');

		// if successful redirect to thanks or
		if($m->send()) {
			header('Location: thanks.php');
			die();
		} else {
			$errors[] = 'Sorry, could not send email. Try again later.';
		}
	}

} else {
	$errors[] = 'Something went wrong.';
}

$_SESSION['errors'] = $errors;
$_SESSION['fields'] = $fields;

header('Location: index.php');
