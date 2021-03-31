
<?php
include("header.inc.php");




if (isset($_POST['conversation_search'])) {



$search = test_input($_POST['conversation_search']);

if (!empty($search)) {
$query = "SELECT * FROM users WHERE (user_id != '$user_id') AND (user_firstname LIKE '%$search%' OR user_lastname LIKE '%$search%' OR user_username LIKE '%$search%')";

} else {

$query = "SELECT * FROM users WHERE user_id != '$user_id'";

}


$query = mysqli_query($connection, $query);
$num_rows = mysqli_num_rows($query);

if ($num_rows != 0) {



while($row = mysqli_fetch_array($query)) {

$friend_user_id = $row['user_id'];

  $select_last_message = "SELECT * FROM messages WHERE (message_sender = '$friend_user_id' OR message_sender = '$user_id') AND (message_reciever = '$friend_user_id' OR message_reciever = '$user_id') ORDER BY message_timestamp DESC LIMIT 1";
  $select_last_message = mysqli_query($connection, $select_last_message);
  $last_message_row = mysqli_fetch_assoc($select_last_message);

?>

            <a onclick="conversation(<?php echo $friend_user_id; ?>)" href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                <img class="img-circle media-object" src="profile_img/<?php echo $row['user_avatar']; ?>">
                </span>
                <div class="media-body">
                  <strong><?php echo ucfirst($row['user_firstname']) . " " . ucfirst($row['user_lastname']); ?></strong>
                  <div class="media-body-secondary">
                    <?php 
if (mysqli_num_rows($select_last_message) != 0) {
if ($last_message_row['message_reciever'] == $user_id) {
        if ($last_message_row['message_seen'] != 0) {

        echo ucfirst($row['user_firstname']) . ": " . substr($last_message_row['message_content'], 0, 35) . "&hellip;";

        } else {
        echo "<b>" . ucfirst($row['user_firstname']) . ": " . substr($last_message_row['message_content'], 0, 35) . "&hellip;</b>";

        }
} else {
echo "me: " . substr($last_message_row['message_content'], 0, 35) . "&hellip;";

}
} else {

echo "message " . ucfirst($row['user_firstname']);
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
}

?>