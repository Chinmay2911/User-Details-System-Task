<?php

session_start();
$db = new mysqli('localhost', 'root', '', 'registration');
if ($db -> connect_errno) 
{
  echo "Error!!!";
  exit();
}
?>