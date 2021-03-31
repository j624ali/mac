<?php

if (isset($_POST['conversation_search'])) {
$conversation_search_query = test_input($_POST['conversation_search']);
if (!empty($conversation_search_query)) {




$query = "SELECT * FROM users WHERE (user_id != '$user_id') AND (user_firstname LIKE '%$conversation_search_query%' OR user_lastname LIKE '%$conversation_search_query%' OR user_username LIKE '%$conversation_search_query%') ORDER BY user_last_message DESC";
$query = mysqli_query($connection, $query);

if (mysqli_num_rows($query) != 0) {
while ($row = mysqli_fetch_assoc($query)) {

$friend_user_id = $row['user_id'];
$select_last_message = "SELECT * FROM messages WHERE (message_sender = '$friend_user_id' OR message_sender = '$user_id') AND (message_reciever = '$friend_user_id' OR message_reciever = '$user_id') ORDER BY message_timestamp DESC LIMIT 1";
$select_last_message = mysqli_query($connection, $select_last_message);
$last_message_row = mysqli_fetch_assoc($select_last_message);


?>





            <a onclick="conversation(<?php echo $friend_user_id; ?>)" class="list-group-item">
              <div class="media">
                <span class="media-left">
                <img class="img-circle-sm media-object" src="profile_img/<?php echo $row['user_avatar']; ?>">
                </span>
                <div class="media-body">
                  <strong><?php echo ucfirst($row['user_firstname']) . " " . ucfirst($row['user_lastname']); ?></strong>
                  <div class="text-muted">
                    <?php 
if (mysqli_num_rows($select_last_message) != 0) {
if ($last_message_row['message_reciever'] == $user_id) {
        if ($last_message_row['message_seen'] != 0) {

        echo substr($last_message_row['message_content'], 0, 35);
        echo " &middot; " . timestamp($last_message_row['message_timestamp']);;
if (strlen($last_message_row['message_content']) > 35) {echo  "&hellip;";}

        } else {
        echo "<b>" . substr($last_message_row['message_content'], 0, 35) . "</b>";
        echo " &middot; " . timestamp($last_message_row['message_timestamp']);;
if (strlen($last_message_row['message_content']) > 35) {echo  "<b>&hellip;</b>";}

        }
} else {

echo "You: " . substr($last_message_row['message_content'], 0, 35);
if (strlen($last_message_row['message_content']) > 35) {echo  "&hellip;";}
}
} else {

echo "Message " . ucfirst($row['user_firstname']);
}

                    ?>
                  </div>
                </div>
              </div>
            </a>






<?php
}
} else {

	echo "<center class='p-a text-muted'>No results</center>";
}






} else {

include "conversations_get.inc.php";
?>
<script type="text/javascript">
  var display_conversations = setInterval(function(){

$("#conversations").load("external/conversations.inc.php");


}, 1000);
</script>
<?

}
} else {

include "conversations_get.inc.php";
?>
<script type="text/javascript">
  var display_conversations = setInterval(function(){

$("#conversations").load("external/conversations.inc.php");


}, 1000);
</script>
<?
}