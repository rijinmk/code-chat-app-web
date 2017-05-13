<?php

  require 'includes/core.inc.php';

  if(!loggedin()){
    header('Location: index.php');
  }

  $username_logged_in = $_SESSION['username'];
  $query = "SELECT * FROM `users` WHERE `username`='$username_logged_in'";
  $query_run = mysqli_query($link, $query);
  $user_info = mysqli_fetch_assoc($query_run);
  $fullname = $user_info['fullname'];
  $country_code = $user_info['country_code'];

?>
<html>
  <head>
    <title>ELEOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/profile.css">
    <style>
    </style>
  </head>

  <body>
    <div id="wrapper">
      <div id="main_chat">

        <div class="info_header">
          <img src="style/images/users/<?php echo $username_logged_in; ?>.png" class="user_dp"/>
          <div class="user_fullname"><?php echo $fullname; ?></div>
          <br><div class="user_username">@<?php echo $username_logged_in; ?></div>
          <ul>
            <li class="color_selected" style="background:#FFFFFF;"></li>
            <li style="background:#59D8E6;"></li>
            <li style="background:#DAEDE2;"></li>
            <li style="background:#BDF271;"></li>
            <li style="background:#BDD684;"></li>
          </ul>
          <a href="includes/logout.inc.php"><div class="logout_me">LOGOUT</div></a>
        </div>

        <div id="chat_here">
          <input placeholder="Enter message here..." type="text" id="chat_text">
          <div id="send_chat_text" onclick="send_message()">SEND</div>
        </div>

        <div id="chats_holder">
          <div id="messages">
          </div>
          <div id="online_people">
            <h5 align="center">ONLINE</h5>
            <div id="online">
            </div>
          </div>
        </div>

      </div>
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

    var color_selected = "rgb(255, 255, 255)";
    $('.info_header ul li').on('click',function(){
      color_selected = $(this).css('background-color');
      $('.info_header ul li').removeClass('color_selected');
      $(this).addClass('color_selected');
      console.log(color_selected);
    });

    function send_message(){
      if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
      }else{
        xmlhttp = new ActiveXObject();
      }

      var username = "<?php echo $username_logged_in; ?>";
      var fullname = "<?php echo $fullname; ?>";
      var country_code = "<?php echo $country_code; ?>";
      var color = color_selected;
      var message = $('#chat_text').val();

      var get_url = "username="+username+"&fullname="+fullname+"&message="+message+"&color="+color+"&country_code="+country_code;
      console.log(get_url);
      xmlhttp.open('POST','includes/send.inc.php',true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(get_url);
      $('#chat_text').val('');
      $('#chat_text').focus();
    }

    function get_message(){
      $.ajax({
        url: 'includes/get.inc.php',
        success: function(data){
          $('#messages').html(data);
        }
      });
    }

    function get_online(){
      $.ajax({
        url: 'includes/get_online.func.php',
        success: function(data){
          $('#online').html(data);
        }
      })
    }

    setInterval(function(){
      get_online();
    },2000);

    var message_box;

    setInterval(function(){
      get_message();
    },1000);
  </script>
</html>
