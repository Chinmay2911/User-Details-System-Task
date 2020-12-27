<?php
	require 'connection.php';
    if (isset($_SESSION['admin'])&& $_SESSION['admin'] == "admin") 
    {
        if (isset($_GET['type'])&& $_GET['type']=='verify') 
        {
            $id =   mysqli_real_escape_string($db, $_GET['id']);
            $action =   mysqli_real_escape_string($db, $_GET['action']);
            if ($action=='Deactivate') {
                $temp=0;
            }
            elseif ($action=='Activate') {
                $temp=1;
            }
            else{
                $temp=0;
            }
            $sql = "UPDATE `users` SET `verification`='".$temp."' WHERE `id`= '".$id."'";

            if ($db->query($sql) === TRUE) {
            } else {
              echo "Error updating record: " . $db->error;
            }
        }
        if (isset($_GET['type'])&& $_GET['type']=='delete') 
        {
            $id =   mysqli_real_escape_string($db, $_GET['id']);
            $sql = "DELETE FROM `users` WHERE `id` ='".$id."'";

            if ($db->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $db->error;
            }
        }
    }
    else{
        header('Location: admin_login.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <div style="text-align: center;">
    <h1>Admin Pannel</h1>
    <p>Here admin can View details about the userm Active, Deactivate user and Delete user</p> <br>
  </div>

<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>Full Name</th>
      <th>Email ID</th>
      <th>City</th>
      <th>Verification</th>
      <th>Delete</th>
    </tr>
        <?php 
        $sql = "SELECT * FROM `users`";
        $result = $db->query($sql);

        if ($result->num_rows > 0) 
        {
          // output data of each row
          while($row = $result->fetch_assoc()) 
          {
            echo('
                <tr><td>'.$row['fullname'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['city'].'</td>
                <td><a class="button button3" href="?type=verify&action='.(($row['verification']==1) ? ('Deactivate') : ('Activate')).'&id='.$row['id'].'">'.(($row['verification']==1) ? ('Deactivate') : ('Activate')).' ?</a></td>
                <td><a class="button button4" href="?type=delete&id='.$row['id'].'">Delete</a></td></tr>
                ');
          }
        } else 
        {
          echo "0 results";
        } 
        ?>
  </table> 
  <br>
  <a class="button button3" href="logout.php">Logout</a>
</div>

</body>
</html>
