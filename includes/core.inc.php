<?php
  require 'connect.inc.php';
  require 'functions/get_ipinfo.func.php';
  require 'functions/chat.func.php';

  ob_start();
  session_start();

  function loggedin(){
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
      return true;
    }else{
      return false;
    }
  }

?>
