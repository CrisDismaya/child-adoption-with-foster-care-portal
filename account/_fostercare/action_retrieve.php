<?php
  include'../../security/connection.php';
  
  if(isset($_POST['res'])){
    $creden_user_id = $_POST['creden_id'];
    $foster_user_id = $_POST['foster_id'];
    $msg_user_content = $_POST['msg_content'];
    $show = mysqli_query($con, "SELECT * FROM message WHERE msgFparentId = '$foster_user_id'");

    while($row = mysqli_fetch_array($show)){
      // echo "<li><b>$row[msgFparentId]</b> : </li>";
      $message_content = $row['msgContent'];
      $message_date = $row['msgCreated'];
      $newmessage_date = date("m/d/Y h:i A", strtotime($message_date));

      echo '
      <li class="left clearfix">
        <span class="chat-img1 pull-left">
          <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
        </span>

        <div class="chat-body1 clearfix">
          <p>'. $message_content .'</p>
          <div class="chat_time pull-right">'. $newmessage_date .'</div>
        </div>
      </li>
      ';
    }
  } 

 
?>