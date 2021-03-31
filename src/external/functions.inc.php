<?php


include ("db.inc.php");

date_default_timezone_set('America/New_York'); 


function test_input($data) {
include ("db.inc.php");

  $data = trim($data);
  $data = stripslashes($data);
  $data = mysqli_escape_string($connection, $data);  
  $data = htmlspecialchars($data);
  return $data;
}
function test_post_input($data) {
include ("db.inc.php");

  $data = str_replace("'","\\\'",$data);
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

function is_email($email) {

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	return true;
} else {

	return false;

}
}


function validate_username($str) {

    $allowed = array(".", "_");
    if(ctype_alnum(str_replace($allowed, '', $str))) {
        return true;
    } else {
        return false;
    }
}



 function timestamp($timestamp) {  
     
      $time_ago         = strtotime($timestamp);  
      $current_time     = time();  
      $time_difference  = $current_time - $time_ago;  
      $seconds          = $time_difference;  
      $minutes          = round($seconds / 60 );
      $hours            = round($seconds / 3600);
      $days             = round($seconds / 86400);
      $weeks            = round($seconds / 604800);
      $months           = round($seconds / 2629440);
      $years            = round($seconds / 31553280);
     
     
      if($seconds <= 60)  
      {  
     return "just now";  
   }  
      else if($minutes <=60)  
      {  
     if($minutes==1)  
           {  
       return "1 min ago";  
     }  
     else  
           {  
       return "$minutes mins ago";  
     }  
   }  
      else if($hours <=24)  
      {  
     if($hours==1)  
           {  
       return "1 hr ago";  
     }  
           else  
           {  
       return "$hours hrs ago";  
     }  
   }  
      else if($days <= 7)  
      {  
     if($days==1)  
           {  
       return "yesterday";  
     }  
           else  
           {  
       return "$days days ago";  
     }  
   }  
      else if($weeks <= 4.3)
      {  
     if($weeks==1)  
           {  
       return "1 week ago";  
     }  
           else  
           {  
       return "$weeks weeks ago";  
     }  
   }  
       else if($months <=12)  
      {  
     if($months==1)  
           {  
       return "1 month ago";  
     }  
           else  
           {  
       return "$months months ago";  
     }  
   }  
      else  
      {  
     if($years==1)  
           {  
       return "1 year ago";  
     }  
           else  
           {  
       return "$years years ago";  
     }  
   }  
 }  

 function opposite_bool($bool) {

if ($bool) {

return 0;

} else {

return 1;

}

 }

 function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}







