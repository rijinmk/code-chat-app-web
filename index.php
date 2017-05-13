<?php

  require 'includes/core.inc.php';

  if(loggedin()){
    header('Location: profile.php');
  }

  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    if(!empty($username) && !empty($password)){
      $query = "SELECT `username`,`password` FROM `users` WHERE `username`='$username' AND `password`='$password_hash' ";
      $query_run = mysqli_query($link, $query);
      $userexists = mysqli_num_rows($query_run);
      if($userexists){
        $_SESSION['username'] = $username;
        $query = "UPDATE `users` SET `status`=1 WHERE `username`='$username'";
        mysqli_query($link, $query); 
        header('Location: profile.php');
      }else{
        $error = "Wrong username or password";
      }
    }else{
      $error = "Please fill in the details";
    }
  }

?>
<html>
  <head>
    <title>WELCOME TO ELEOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <style>
    </style>
  </head>

  <body>
    <div id="wrapper">
      <!--LOGIN FORM-->
      <div id="form_holder">
        <div id="error"><?php echo @$error; ?></div>
        <h2 align="center">ELEOS</h2>
        <!--FORM ITSELF-->
        <form action="index.php" method="POST">
          <div class="inp_coll">
            <label>USERNAME</label><br>
            <input type="text" name="username">
          </div>

          <div class="inp_coll">
            <label>PASSWORD</label><br>
            <input type="password" name="password">
          </div>

          <div class="inp_coll">
            <input id="submit_btn" type="submit" name="submit" value="LOGIN">
          </div>
        </form>
        <!--FORM ITSELF END-->
        <h5 align="center">Dont have an account? <br><a href="register.php">Register</a></h5>
      </div>
      <!--LOGIN FORM END-->
    </div>
  </body>

  <script src="script/plugins/jq.js"></script>
  <script>
    $(document).ready(function(){
      var error = $('#error').html();
      if(error){
        $('#error').fadeIn();
      }
    });
  </script>
</html>
