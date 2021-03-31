     <div class="modal-header">
        <button type="button" class="close m-b" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <div class="modal-body p-a-0">
        <input autocomplete="off" type="text" id="conversation_search" class="form-control btns-pill" placeholder="Search...">
      </div>
      </div>

      <div class="modal-body p-a-0 js-modalBody">

        <div class="modal-body-scroller">
          <div id="conversations" class="media-list media-list-users list-group">


          </div>

          
        </div>

      </div>






<script type="text/javascript">
          $("#conversation_search").keyup(function() {
          var conversation_search = $("#conversation_search").val();

          
          $("#conversations").load("external/conversation_search.inc.php", {
             
              conversation_search: conversation_search 
              
          });

});
function conversation($friend_id){$(".msgModalBody").load("external/messages.inc.php",{friend_id: $friend_id});}

</script>
