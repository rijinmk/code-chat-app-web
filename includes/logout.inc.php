<?php

  require 'core.inc.php';

  session_start();

  $user_logged_in = $_SESSION['username'];
  $query = "UPDATE `users` SET `status`=0 WHERE `username`='$user_logged_in'";
  mysqli_query($link, $query);

  session_destroy();

  header('Location: ../index.php');

?>
