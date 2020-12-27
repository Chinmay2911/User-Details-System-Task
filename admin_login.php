<?php
    require 'connection.php';
    $email = "";
    $password_1 = "";
    $errors = array();

    if (isset($_POST['login'])){
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);


        if ($email == 'admin' && $password_1 = 'admin') 
        {
            $_SESSION['admin'] = 'admin';
            header('Location: admin_output.php');
            exit();
        }
        else
        {
            array_push($errors, "Admin ID invalid!");
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
    <h1 style="text-align: center;">Login Here!</h1>
    <p style="text-align: center;"><b>Kindly fill up the required fields</b></p>

    <div class="header">
        <h2>Login here</h2>
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
            <input type="text" name="email" required>
        </div>

        <div class="input_group">
            <label>Password</label>
            <input type="password" name="password_1" required>
        </div>

        <div class="input_group">
            <button type="submit" name="login" class="button button1">Login</button>
        </div>
        <p>Not yet a member? <a href="user_register.php">Register</p>
    </form>
</body>
</html>