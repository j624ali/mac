<?php

include("header.inc.php");



$friend_id = $_POST['friend_id'];

$query = "SELECT * FROM messages WHERE (message_sender = '$friend_id' OR message_sender = '$user_id') AND (message_reciever = '$friend_id' OR message_reciever = '$user_id') ORDER BY message_timestamp ASC";
$query = mysqli_query($connection, $query);
$num_rows = mysqli_num_rows($query);

$friend_query = "SELECT * FROM users WHERE user_id = '{$friend_id}'";
$friend_query = mysqli_query($connection, $friend_query);
$friend_row = mysqli_fetch_assoc($friend_query);






while ($row = mysqli_fetch_assoc($query)) {







if ($user_id == $row['message_sender']) {
?>





             <li class="media media-current-user m-b-md">
                <div class="media-body">
                  <div class="media-body-text">
                    <?php echo $row['message_content']; ?>
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <?php echo timestamp($row['message_timestamp']); ?>
                      <?php if ($row['message_seen'] == 1) {echo " - seen";} ?>
                    </small>
                  </div>
                </div>
                <a class="media-right" href="#">
                  <img class="img-circle media-object" src="../profile_img/<?php echo $user_avatar; ?>">
                </a>
              </li>



<?php

} else {

?>


  <li class="media m-b-md">
    <a class="media-left" href="#">
      <img class="img-circle media-object" src="../profile_img/<?php echo $friend_row['user_avatar']; ?>">
    </a>
    <div class="media-body">
      <div class="media-body-text">
      <?php echo $row['message_content']; ?>
      </div>
      <div class="media-footer">
        <small class="text-muted">
          <?php echo timestamp($row['message_timestamp']); ?>
        </small>
      </div>
    </div>
  </li>


<?php

}



if ($user_id == $row['message_reciever'] && $row['message_seen'] !== 1) {


$seen_query = "UPDATE messages SET `message_seen` = 1 WHERE `message_reciever` = {$user_id}";
$seen_query = mysqli_query($connection, $seen_query);


}

}


?>
<!-- <script>
      $('#conversation').bind('scroll', function()
                              {
                                if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight)
                                {
                                  $('#conversation').scrollTop($(document).height());

                                }
                              })

</script>



 -->







