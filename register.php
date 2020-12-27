<?php
	require 'connection.php';
	$email = "";
	$fullname = "";
	$city = "";
	$password_1 = "";
	$password_2 = "";
	$errors = array();

	if (isset($_POST['register'])){
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$fullname = mysqli_real_escape_string($db, $_POST['fullname']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		$sql = "SELECT * FROM `users` WHERE `email` = '".$email."'";
		$result = $db->query($sql);

		if ($result->num_rows > 0) {
			array_push($errors, "Email ID Already Exist");
		}
		if (count($errors) == 0) {
			$sql = "INSERT INTO `users`(`email`, `password`, `fullname`, `city`, `verification`) VALUES ('".$email."','".md5($password_1)."','".$fullname."','".$city."','0')";

			if ($db->query($sql) === TRUE) {
				$_SESSION['email'] = $email;
				header('Location: output.php');
				exit();
			} else {
			  array_push($errors, "Error occured!");
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details System</title>
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1 style="text-align: center;">Register here</h1>
    <br>
    <p style="text-align: center;">Kindly fill up the required fields</p>

    <div class="header">
        <h2>User Registration</h2>
    </div>

    <form method="POST">
        <?php  if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php  endif ?>
    	<div class="input_group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input_group">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
        </div>

        <div class="input_group">
            <label>City</label>
            <input type="text" name="city" required>
        </div>

        <div class="input_group">
            <label>Password</label>
            <input type="password" name="password_1" required>
        </div>

        <div class="input_group">
            <label>Confirm Password</label>
            <input type="password" name="password_2" required>
        </div>

        <div class="input_group">
            <button type="submit" name="register" class="button button1">Register</button>
        </div>
        <p>Already a member? <a href="login.php">Sign in</p>
    </form>
</body>
</html>