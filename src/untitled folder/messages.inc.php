


<?php include("header.inc.php"); ?>

<?php if (isset($_POST['load_method'])) { 

$load_method = $_POST['load_method'];




if ($load_method == "conversations") {
?>

   <div class="modal-header">
        <button type="button" class="close m-b" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <div class="modal-body p-a-0">
        <input autocomplete="off" type="text" id="conversation_search" class="form-control btns-pill" placeholder="Search...">
      </div>
      </div>

      <div class="modal-body p-a-0 js-modalBody">

        <div class="modal-body-scroller">
          <div id="conversations" class="media-list media-list-users list-group">


<?php



$query = "SELECT * FROM users WHERE user_id != '$user_id'";

$query = mysqli_query($connection, $query);
$num_rows = mysqli_num_rows($query);

if ($num_rows != 0) {


while($row = mysqli_fetch_array($query)) {

$friend_user_id = $row['user_id'];

  $select_last_message = "SELECT * FROM messages WHERE (message_sender = '$friend_user_id' OR message_sender = '$user_id') AND (message_reciever = '$friend_user_id' OR message_reciever = '$user_id') ORDER BY message_timestamp DESC LIMIT 1";
  $select_last_message = mysqli_query($connection, $select_last_message);
  $last_message_row = mysqli_fetch_assoc($select_last_message);

?>

            <a onclick="conversation(<?php echo $friend_user_id; ?>)" class="list-group-item">
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

  echo "<h4>Nothing found for \"$search\"</h4>";
}


?>

          </div>

          
        </div>

      </div>

<?php

} elseif ($load_method == "conversation_search") { ?>





<?php } } ?>







  

<script type="text/javascript">

          $("#conversation_search").keyup(function() {
          var conversation_search = $("#conversation_search").val();

          
          $("#conversations").load("external/conversation_search.inc.php", {
             
              conversation_search: conversation_search 
              
          });

});

function conversation($friend_id){$(".msgModalBody").load("external/display_messages.inc.php",{friend_id: $friend_id});}

  
            $('#message-box').submit(function(event){
               
          event.preventDefault();

                var message = $('#message-input').val();
                $('#message-input').val("");
                var friend = <?php echo $friend_id; ?>;

                

  $.post("../external/send_message.inc.php", {friend: friend, message: message});




}); 



  function display_conversation() {

$(".media-list-conversation").load("../external/display_messages.inc.php", {

friend_id: <?php echo $friend_id; ?>

});
}

display_conversation();



setInterval(function(){

display_conversation();

}, 1000);



</script>

