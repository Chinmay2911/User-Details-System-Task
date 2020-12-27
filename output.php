<?php
	require 'connection.php';
    if (isset($_SESSION['email'])&& $_SESSION['email'] != "") {
        $sql = "SELECT * FROM `users` WHERE `email` = '".$_SESSION['email']."'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          $row = $result->fetch_assoc();
          echo('
            <h2 style="text-align: center;">Welcome: '.$row['email'].' </h2> <br />
            ');
          if ($row['verification'] == 1) {

            ?>
            <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<h3 style="text-align: center;">This is User's Info</h3><br>
<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>Email ID</th>
      <th>Full Name</th>
      <th>City</th>
    </tr>

            <?php 
              $sql1 = "SELECT * FROM `users` WHERE `verification` =  '1'";
                $result1 = $db->query($sql1);

                if ($result1->num_rows > 0) {

                  while($row1 = $result1->fetch_assoc()) {
                    echo ('
                        <tr>
                          <td>'.$row1["email"].'</td>
                          <td>'.$row1["fullname"].'</td>
                          <td>'.$row1["city"].'</td>
                        </tr>
                        ');
                  }
                }
                ?>
</table>
<br>
<a class="button button3" href="logout.php">Logout</a>
</div>

</body>
</html>
            <?php 
            }
          else
          {
            echo "Account not verified yet!";
          }
        } else 
        {
          echo 'No Account exist, Kindly login at <a href="login.php">here</a>';
        }
    }
    else
    {
        echo('<script>
            window.location.href ="login.php"
            </script>');
    }

?>