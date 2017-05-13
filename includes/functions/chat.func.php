<?php
  function get_messages($limit){
    global $link;
    $query = "SELECT * FROM `chats` ORDER BY  `msg_id` DESC LIMIT $limit";
    $query_run = mysqli_query($link, $query);
    $all_chats = array();
    while($fetching_chats = mysqli_fetch_assoc($query_run)){
      array_push($all_chats,$fetching_chats);
    }
    return $all_chats;
  }

  function get_online_people(){
    global $link;
    $query = "SELECT `username`,`fullname` FROM `users` WHERE `status`=1";
    $query_run = mysqli_query($link, $query);
    $all_online = array();
    while($fetching_online = mysqli_fetch_assoc($query_run)){
      array_push($all_online, $fetching_online);
    }
    return $all_online;
  }

  //TESTING AREA
  //send_message('Rijin Mk', 'rijinmk','I am just tringasdasd', '#000000', 'ae');
  //print_r(get_messages()[0]['']);
?>
