<?php

  require 'core.inc.php';

  //username fullname message color country_code
  if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['message']) && isset($_POST['color']) /*&& isset($_POST['country_code'])*/){
    $username = mysqli_real_escape_string($link,$_POST['username']);
    $fullname = mysqli_real_escape_string($link,$_POST['fullname']);
    $message = mysqli_real_escape_string($link,$_POST['message']);
    $color = mysqli_real_escape_string($link,$_POST['color']);
    $country_code = mysqli_real_escape_string($link,$_POST['country_code']);
    if(!empty($username) && !empty($fullname) && !empty($message) && !empty($color) && !empty($country_code)){
      $query = "INSERT INTO `chats` VALUES('','$username','$fullname','$message','$color','$country_code')";
      mysqli_query($link, $query);
    }
  }

?>
