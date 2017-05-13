<?php
  require 'includes/core.inc.php';

  if(loggedin()){
    header('Location: profile.php');
  }

  // $user_ip = $_SERVER['REMOTE_ADDR'];
  // $country_info = ip_info("172.17.49.1", "location");
  // $country = $country_info['country'];
  // $country_code = $country_info['country_code'];
  // $country_code = strtolower($country_code);
  $country_code = "ae";

  if(isset($_POST['fullname_reg']) && isset($_POST['username_reg']) && isset($_POST['password_reg']) && isset($_POST['confirm_pass']) && isset($_POST['country_code'])){
    //INIT USER INFO
    $fullname = $_POST['fullname_reg'];
    $username = $_POST['username_reg'];
    $password = $_POST['password_reg'];
    $conf_pass = $_POST['confirm_pass'];

    //INIT DP
    $dp_name = $_FILES['profile_pic']['name'];
    $dp_temp_name = $_FILES['profile_pic']['tmp_name'];
    $dp_size = $_FILES['profile_pic']['size'];

    if(!empty($fullname) && !empty($username) && !empty($password) && !empty($conf_pass)){
      if(!empty($dp_temp_name)){
        if($conf_pass == $password){
          //USERNAME CHECK
          $query = "SELECT `username` FROM `users` WHERE `username`='$username'";
          $query_run = mysqli_query($link,$query);
          $username_exists = mysqli_num_rows($query_run);

          //IF USERNAME EXISTS
          if($username_exists){
            $error = "This username already exists.";
          }else{
            //IF USERNAME NO EXIST
            //CHECK IF PERSON UPLOAD DP
            if(isset($dp_name)){
              if(!empty($dp_name)){
                $extension = pathinfo($dp_name, PATHINFO_EXTENSION);
                if($extension!=".png"){
                  imagepng(imagecreatefromstring(file_get_contents($dp_temp_name)), "style/images/users/".$username.".png");
                }else{
                  move_uploaded_file($dp_temp_name, "style/images/users/".$username.'.'.$extension);
                }
              }
            }
            //INSERTING INTO DATABASE
            $password_hash = md5($password);
            $query = "INSERT INTO `users` VALUES('','$fullname','$username','$password_hash','$country_code','')";
            if(mysqli_query($link, $query)){
              header('Location: index.php');
            }else{
              $error = "Couldn't login";
            }
          }
        }else{
          $error = "Passwords dont match";
        }
      }else{
        $error = "Please choose a profile picture.";
      }
    }else{
      $error = "Please fill in all the details.";
    }
  }

?>

<html>
  <head>
    <title>REGISTER FOR ELEOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/register.css">
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
        <form action="register.php" method="POST" enctype="multipart/form-data">
          <div class="inp_coll">
            <label>FULL NAME</label><br>
            <input type="text" value="<?php echo @$fullname; ?>" name="fullname_reg">
          </div>

          <div class="inp_coll">
            <label>USERNAME</label><br>
            <input type="text" value="" name="username_reg">
          </div>

          <div class="inp_coll">
            <label>PASSWORD</label><br>
            <input type="password" name="password_reg">
          </div>

          <div class="inp_coll">
            <label>CONFIRM</label><br>
            <input type="password" name="confirm_pass">
          </div>

          <div class="inp_coll">
            <label>PROFILE PICTURE</label><br>
            <div id="upoload_dp">UPLOAD</div>
            <input id="upoload_dp_hidden" type="file" name="profile_pic"><br>
          </div>

          <div class="inp_coll">
            <label>COUNTRY</label><br>
            <input type="hidden" value="<?php echo $country_code; ?>" name="country_code"/>
            <div class="country"><?php echo "United Arab Emirates"; ?></div>
            <div class="country_code"><?php echo $country_code; ?> &nbsp; <img class="country_flag" src="style/images/icons/flags/<?php echo $country_code; ?>.png"></div>
          </div>

          <div class="inp_coll">
            <input id="submit_btn" type="submit" name="submit" value="REGISTER">
          </div>
        </form>
        <!--FORM ITSELF END-->

        <h5 align="center">Already have an account? <br><a href="index.php">LOGIN</a></h5>
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
