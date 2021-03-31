<?php include("../external/header.inc.php"); ?>


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
Home

    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../assets/css/toolkit.css" rel="stylesheet">
    
    <link href="../assets/css/application.css" rel="stylesheet">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/toolkit.js"></script>
    <script src="../assets/js/application.js"></script>





  </head>
<script type="text/javascript">
  
    $(document).ready(function(){


function load_conversations() {
$("#conversations").load("../external/conversation_search.inc.php");


}

load_conversations();

setInterval(load_conversations, 1500);
          



$("#conversation_search").keyup(function() {
          var conversation_search = $("#conversation_search").val();

          
          $("#conversations").load("../external/conversation_search.inc.php", {
             
              conversation_search: conversation_search 
              
          });

});






});


</script>


  



<div class="p-a-0">


    <div id="body" class="col-md-12">
      <div class="panel panel-default">

        <div class="modal-header">

        <input autocomplete="off" type="text" id="conversation_search" class="form-control btn-pill" placeholder="Search...">

      </div>
        <div class="panel-body">

          <div id="conversations" class="media-list-users">



   
          </div>
        </div>
      </div>
    </div>
             

  </div>

<script>function conversation($friend_id){$("#body").load("../external/messages.inc.php",{friend_id: $friend_id});}</script>
    

