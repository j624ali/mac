<?php if (isset($_POST['id'])) { ?>

<?php include("header.inc.php"); ?>



      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 onclick="modal_conversations()"class="modal-title text-primary"><a href="#"><span class="icon icon-chevron-left"></span>Back</a></h4>
      </div>
      <div class="modal-body modal-body-scroller">
<ul class="media-list media-list-conversation c-w-md">

</ul>
      </div>

      <div class="modal-body">
        <form id="message-box">
        <input autocomplete="off" id="message-input" type="text" class="form-control" placeholder="Message">
        </form>
      </div>


<script type="text/javascript">
// $("#conversations").load("external/conversations.inc.php");

//           $("#conversation_search").keyup(function() {
//           var conversation_search = $("#conversation_search").val();

          
//           $("#conversations").load("external/conversations.inc.php", {conversation_search: conversation_search});

// });

  function display_conversation() {

$(".media-list-conversation").load("external/display_messages.inc.php", {

id: <?php echo $_POST['id'];?>

});
}

display_conversation();



setInterval(function(){

display_conversation();

}, 1000);


          $('#message-box').submit(function(event){
               
          event.preventDefault();

                var message = $('#message-input').val();
                $('#message-input').val("");
                var friend = <?php echo $_POST['id']; ?>;

                

  $.post("external/send_message.inc.php", {friend: friend, message: message});




});

	
</script>




<?php } ?>

