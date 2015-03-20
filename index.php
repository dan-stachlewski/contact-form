<?php 
session_start();

require_once 'helpers/security.php';

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/main.css"/>
</head>

<body>

<div class="contact">

	<?php if(!empty($errors)): ?>
		<div class="panel">
			<!-- Errors will go here -->
			<ul>
				<li><?php echo implode('</li><li>', $errors); ?></li>
			</ul>
		</div>
	<?php endif; ?>

	<form action="contact.php" method="POST">
		<label>
			Your Name: *
			<input type="text" name="name" autocomplete="off" <?php echo isset($fields['name']) ? ' value="' . e($fields['name']) . '"' : '' ?>/>
		</label>
		<label>
			Your Email Address: *
			<input type="text" name="email" autocomplete="off" <?php echo isset($fields['email']) ? ' value="' . e($fields['email']) . '"' : '' ?>/>
		</label>
		<label>
			Your message: *
			<textarea name="message" rows="8"><?php echo isset($fields['message']) ? e($fields['message']) : '' ?></textarea>
		</label>
		
		<input type="submit" value="Send">

		<p class="muted">* means a required field</p>

	</form>


</div> <!-- /END contact -->
</body>
</html>

<?php 

ian.brown@vu.edu.au

unset($_SESSION['errors']);
unset($_SESSION['fields']);


?>