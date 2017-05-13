<?php

  require 'core.inc.php';

  // <div id='online-1' class='onlines'>
  //   <img class='user_dp_online' src='style/images/users/rmk.png'>
  //   <div class='user_dp_fullname'>RIJIN MK</div>
  // </div>

  $all_online = get_online_people();
  for($i=0; $i<count($all_online); $i++){
    echo "<div id='online-".($i+1)."' class='onlines'>";
    echo "<img class='user_dp_online' src='style/images/users/".$all_online[$i]['username'].".png'>";
    echo "<div class='user_dp_fullname'>".$all_online[$i]['fullname']."</div>";
    echo "</div>";
  }

?>
