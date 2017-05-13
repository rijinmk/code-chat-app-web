<?php

  $host = 'localhost';
  $username = 'rmk';
  $password = '';

  $database = 'eleos';

  $link = mysqli_connect($host, $username, $password) or die("Couldn't connect to server");
  mysqli_select_db($link, $database) or die("Couldn't connect to database");

?>
