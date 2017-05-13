<?php

  require 'core.inc.php';

  // <div id='message-1' class='each_message'>
  //   <img class='each_message_dp' src='style/images/users/rijinmk.png' />
  //   <div style='background:rgb(255, 211, 78);' class='inner_info'>
  //     <div class='each_message_fullname'>Rijin Mk <img class='each_message_flag' src='style/images/icons/flags/ae.png'></div>
  //     <div class='each_message_text'><i>Hello there!</i></div>
  //   </div>
  // </div>

  $all_messages = get_messages(30);
  for($i=0; $i<count($all_messages); $i++){
    $username = $all_messages[$i]['username'];
    $fullname = $all_messages[$i]['fullname'];
    $message = $all_messages[$i]['message'];
    $color = $all_messages[$i]['color'];
    $country_code = $all_messages[$i]['country_code'];
    $img_src = "style/images/users/".$username.".png";

    echo "<div id='message-".($i+1)."' class='each_message'>";
    echo "<img class='each_message_dp' src='".$img_src."'/>";
    echo "<div style='background:".$color.";' class='inner_info'>";
    echo "<div class='each_message_fullname'>".$fullname." <img class='each_message_flag' src='style/images/icons/flags/".$country_code.".png'></div>";
    echo "<div class='each_message_text'><i>".$message."</i></div>";
    echo "</div>";
    echo "</div>";
  }

?>
