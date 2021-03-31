<?php include("external/header.inc.php"); ?>

    <?php

        $select_all_friends = "SELECT * FROM users WHERE user_id != $user_id";
        $select_all_friends = mysqli_query($connection, $select_all_friends);
        $select_all_friends_num_rows = mysqli_num_rows($select_all_friends);

        $select_friends = "SELECT * FROM users WHERE user_id != $user_id LIMIT 2";
        $select_friends = mysqli_query($connection, $select_friends);
        $select_friends_num_rows = mysqli_num_rows($select_friends);        

        $select_user_media = "SELECT `post_file` FROM  posts WHERE post_user_id = $user_id AND post_type = 'image' ORDER BY post_id DESC LIMIT 2";
        $select_user_media = mysqli_query($connection, $select_user_media);
        $select_user_media_num_rows = mysqli_num_rows($select_user_media);
?>

        <!DOCTYPE html>
        <html lang="en">

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
            <link href="assets/css/toolkit.css" rel="stylesheet">
            <link href="assets/css/application.css" rel="stylesheet">

            <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

            <script>
                var colors = new Array([67, 52, 130], [108, 52, 131], [108, 52, 131], [187, 143, 206], [31, 97, 141], [31, 97, 141]);
                var step = 0;
                var colorIndices = [0, 1, 2, 3];
                var gradientSpeed = 0.002;

                function gradient1() {
                    if ($ === undefined) return;
                    var c0_0 = colors[colorIndices[0]];
                    var c0_1 = colors[colorIndices[1]];
                    var c1_0 = colors[colorIndices[2]];
                    var c1_1 = colors[colorIndices[3]];
                    var istep = 1 - step;
                    var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
                    var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
                    var b1 = Math
                        .round(istep * c0_0[2] + step * c0_1[2]);
                    var color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")";
                    var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
                    var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
                    var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
                    var color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")";
                    $('.navbar-inverse').css({
                        background: "-webkit-gradient(linear, left top, right top, from(" + color1 + "), to(" + color2 + "))"
                    }).css({
                        background: "-moz-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)"
                    });
                    step += gradientSpeed;
                    if (step >= 1) {
                        step %= 1;
                        colorIndices[0] = colorIndices[1];
                        colorIndices[2] = colorIndices[3];
                        colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
                        colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
                    }
                }

                setInterval(gradient1, 10);
            </script>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/chart.js"></script>
            <script src="assets/js/toolkit.js"></script>
            <script src="assets/js/application.js"></script>
            <script src="assets/js/autosize.min.js"></script>
            <script src="assets/js/scrollbar.min.js"></script>
            <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

        </head>

        <body class="<?php if ($header_row['dark_mode']){echo "dark";} ?>">

            <div class="growl" id="app-growl"></div>



            <div class="container p-t-md">
                <div class="row">

                    <!--************LEFT SIDEBAR************-->
                    <div class="col-md-3 xs_container">
                        <div class="panel panel-default panel-profile m-b-md">
                            <div class="panel-heading" style="background-image: url(assets/img/iceland.jpg);"></div>
                            <div class="panel-body text-center">
                                <a href="profile/index.html">
                                    <img class="panel-profile-img" src="profile_img/<?php echo $user_avatar; ?>">
                                </a>

                                <h5 class="panel-title">
            <span class="text-inherit" href="profile/index.html"><?php echo ucfirst($user_firstname) . " " . ucfirst($user_lastname); ?></span>
          </h5>


                                <ul class="panel-menu">
                                    <li class="panel-menu-item">
                                        <span class="text-inherit">
                Friends
                <h5 class="m-y-0">

                  <?php echo $select_all_friends_num_rows; ?>

                </h5>
              </span>
                                    </li>

                                    <li class="panel-menu-item">
                                        <span class="text-inherit">
                Rating
                <h5 class="m-y-0">3.85</h5>
              </span>
                                    </li>
                                </ul>
                            </div>
                        </div>

<!--                         <div class="panel panel-default visible-md-block visible-lg-block">
                            <div class="panel-body">
                                <h5 class="m-t-0">About <small>· <a href="#">Edit</a></small></h5>
                                <ul class="list-unstyled list-spaced">
                                    <li><span class="text-muted icon icon-calendar m-r"></span>Went to <a href="#">Longfields</a>
                                        <li><span class="text-muted icon icon-briefcase m-r"></span>Worked at <a href="#">Rivermist</a>
                                            <li><span class="text-muted icon icon-home m-r"></span>Lives in <a href="#">Ottawa, ON</a>
                                                <li><span class="text-muted icon icon-location-pin m-r"></span>From <a href="#">Baghdad, Iraq</a>
                                </ul>
                            </div>
                        </div> -->

<?php if($select_user_media_num_rows != 0) { ?>

                        <div class="panel panel-default visible-md-block visible-lg-block">
                            <div class="panel-body">
                                <h5 class="m-t-0">Media <small>· <a href="#view-all-media" data-toggle="modal">View all</a></small></h5>
                                <div data-grid="images">

                                  <?php while($select_user_media_row = mysqli_fetch_assoc($select_user_media)) { ?>

                                    <div>
                                        <img data-action="zoom" src="post_files/<?php echo $select_user_media_row['post_file']; ?>">
                                    </div>
<?php }?>
                                </div>
                            </div>
                        </div>

            <div class="modal fade" id="view-all-media" tabindex="-1" role="dialog" aria-labelledby="view-all-media" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        </div>

                        <div id="media-feed" class="modal-body list-group media-list media-list-stream">

                        </div>
                    </div>
                </div>
            </div>

<script>
  function load_media_feed() {$("#media-feed").load("external/view_all_media.inc.php");}

load_media_feed();
</script>

            <?php } ?>
                    </div>
                    <!--************END OF RIGHT SIDEBAR************-->







                    <!--************FEED************-->

                    <div class="col-md-6 xs_container">

                          <li class="media list-group-item xs_border">
<div id="server_response"></div>

                                <div class="media-body">
                                    <form action="" enctype="multipart/form-data" id="post-form">
                                        <div class="media-heading">
                                            <div class="row">
                                              <div class="col-md-12">
                                            <textarea class="post-textarea" id="form-text" name="form-text" rows="2" placeholder="Create a post..."></textarea>
                                              </div>
<div class="create-post-hidden display-hsidden">
                                        <div class="col-md-6">

                                                    <input type="file" id="file" name="file" onchange="readURL(this)">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="submit" id="submit">
                                                </div>
</div>


                                            </div>

                                        </div>
                                    </form>
                                </div>


<img style="height: 100px; width: 100px; object-fit:scale-down;" id="file-preview"/>
<script>





       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#file-preview')
                        .attr('src', e.target.result);

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
          
</li>

                        <ul id="feed" class="list-group media-list media-list-stream">

  


                        </ul>
                    </div>
                    <!--************END OF FEED************-->







                    <!--************SIDEBAR************-->
                    <div class="col-md-3 xs_container">

                        <!--ALERT-->

                        <div class="alert alert-waning alert-dismissible hidden-xs alert-dark" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            Update your <a class="alert-link" href="profile/index.html">profile</a>.
                        </div>

                        <!--SPONSORED AD-->
                        <!-- 
      <div class="panel panel-default m-b-md hidden-xs">
        <div class="panel-body">
          <h5 class="m-t-0">Sponsored</h5>
          <div data-grid="images" data-target-height="150">
            <img class="media-object" data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_2.jpg">
          </div>
          <p><strong>It might be time to visit Iceland.</strong> Iceland is so chill, and everything looks cool here. Also, we heard the people are pretty nice. What are you waiting for?</p>
          <button class="btn btn-primary-outline btn-sm">Buy a ticket</button>
        </div>
      </div>

       -->

                        <!--LIKE-->
                        <div class="panel panel-default m-b-md hidden-xs">
                            <div class="panel-body">
                                <h5 class="m-t-0">Friends <small>· <a href="#">View All</a></small></h5>
                                <ul class="media-list media-list-stream">

                                    <?php while($friends_row = mysqli_fetch_assoc($select_friends)) { 

$friend_firstname = $friends_row['user_firstname'];
$friend_lastname = $friends_row['user_lastname'];
$friend_avatar = $friends_row['user_avatar'];

  ?>

                                        <li class="media m-b">
                                            <a class="media-left" href="#">
              <img
                class="media-object img-circle"
                src="profile_img/<?php echo $friend_avatar; ?>">
            </a>
                                            <div class="media-body">
                                                <strong><?php echo  ucfirst($friend_firstname) . " " . ucfirst($friend_lastname); ?></strong> @jane123
                                            </div>
                                        </li>

                                        <?php } ?>

                                </ul>
                            </div>

                        </div>

                        <!--FOOTER-->
                        <div class="panel panel-default panel-link-list">
                            <div class="panel-body">
                                © 2019

                                <a href="#">About Us</a>
                                <a href="#">Help</a>
                                <a href="#">Terms</a>
                                <a href="#">Privacy</a>
                                <a href="#">Contact</a>

                            </div>
                        </div>

                    </div>
                    <!--************END OF SIDEBAR************-->

                </div>
            </div>


            <ul id="menu" class="mfb-component--br mfb-zoomin" data-mfb-toggle="hover">
                <li id="main-button" class="mfb-component__wrap">

                    <span href="#" class="mfb-component__button--main">
          <i class="mfb-component__main-icon--resting ion-plus-round"></i>
          <i class="mfb-component__main-icon--active ion-close-round"></i>
          <div id="main-notification-badge" class="notification_badge"></div>
        </span>

                    <ul class="mfb-component__list">

                        <li>
                            <a data-mfb-label="Notifications" class="mfb-component__button--child" href="#notifications" data-toggle="modal">
                                <i class="mfb-component__child-icon icon icon-bell"></i>
                                <div class="notification_badge"></div>

                            </a>
                        </li>

                        <li>
                            <a data-mfb-label="Messages" class="mfb-component__button--child" href="#msgModal" data-toggle="modal">
              <i class="mfb-component__child-icon icon icon-chat"></i>
                            </a>
                        </li>  

                        <li>
                            <a data-mfb-label="Settings" class="mfb-component__button--child" href="#preferences" data-toggle="modal">
                                <i class="mfb-component__child-icon icon icon-cog"></i>
                            </a>
                        </li>

                        <li>
                            <span data-mfb-label="Logout" onclick="window.location.replace('external/logout.inc.php')" class="mfb-component__button--child">
              <i class="mfb-component__child-icon icon icon-log-out"></i>
            </span>
                        </li>

                    </ul>
                </li>
            </ul>

            <script>
                $(document).ready(function() {





function load_feed($limit) {$("#feed").load("external/feed.inc.php");}

load_feed();




$("#post-form").submit(function(ev){

    ev.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        url: 'external/create_post.inc.php',
        type: 'POST',
        data: formData,
        success: function (server_response) {
            $("#server_response").html(server_response);
        },
        cache: false,
        contentType: false,
        processData: false
    });

});



                    $('#dark_mode').click(function() {$("#dark_mode_toggle").load("external/toggle_dark_mode.inc.php");});

autosize($('textarea'));



                });
            </script>

            <div class="modal fade" id="preferences" tabindex="-1" role="dialog" aria-labelledby="preferences" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Settings</h4>
                        </div>

                        <div class="modal-body">


                                <ul class="media-list media-list-users list-group">

                                    <div class="media">




<hr>

                                          <table class="m-b">
                                            <th>Dark&nbsp;theme</th>
                                            <th>
                                                <div class="media-body">
                                                    <div style="transform: scale(0.75);" class="pull-right">
                                                        <div id="dark_mode_toggle"></div>
                                                        <div class="toggle-switch">
                                                            <input <?php if ($dark_mode) {echo "checked";}?> value="
                                                            <?php echo $dark_mode; ?>" type="checkbox" id="dark_mode"/>
                                                                <label></label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </th>
                                        </table>  
<hr>
<br>

                                    <div id="settings_profile">
                                        <h4>Profile</h4>
                                        <hr>
    <form>
      <div id="_change_username" class="form-group">
        <label for="change_username">Username</label>
        <input name="change_username" id="change_username" class="form-control btn-pill" placeholder="New username" type="text" value="<?php echo $user_username; ?>">
        <small class="text-danger form-feedback" id="change_username_"></small>
      </div>

        <input name="update_username" id="update_username" type="submit" class="btn-small btn-settings-modal btn-pill" value="Save changes">




      
    </form>



<br>
<br>
    <form>
      <div id="_change_firstname" class="form-group">
        <label for="change_firstname">Name</label>
        <input name="change_firstname" id="change_firstname" class="form-control btn-pill" placeholder="New firstname" type="text" value="<?php echo $user_firstname; ?>">
        <small class="text-danger form-feedback" id="change_firstname_"></small>
      </div>

      <div id="_change_lastname" class="form-group">
        <input name="change_lastname" id="change_lastname" class="form-control btn-pill" placeholder="New lastname" type="text" value="<?php echo $user_lastname; ?>">
        <small class="text-danger form-feedback" id="change_lastname_"></small>
      </div>



        <input name="update_name" id="update_name" type="submit" class="btn-small btn-settings-modal btn-pill" value="Save changes">




      
    </form>

                                    </div>

<hr>

                                    <div id="settings_account">
                                        <br>
                                        <br>
                                        <h4>Account</h4>
                                        <hr>

    <form>
      <div id="_change_email" class="form-group">
        <label for="change_email">Email</label>
        <input name="change_email" id="change_email" class="form-control btn-pill" placeholder="New email" type="text" value="<?php echo $user_email; ?>">
        <small class="text-danger form-feedback" id="change_email_"></small>
      </div>

        <input name="update_email" id="update_email" type="submit" class="btn-small btn-settings-modal btn-pill" value="Save changes">




      
    </form>

<br>
<br>
     <form>
      <div id="_current_password" class="form-group">
        <label for="email">Change Password</label>
        <input name="current_password" id="current_password" class="form-control btn-pill" placeholder="Current Password" type="text">
        <small class="text-danger form-feedback" id="current_password_"></small>
      </div>
    <!-- <small><a href="../password_reset">Forgor password?</a></small> -->
      <div id="_new_password" class="form-group">

        <input name="new_password" id="new_password" class="form-control btn-pill" placeholder="New Password" type="text">
        <small class="text-danger form-feedback" id="new_password_"></small>
      </div>
      <div id="_confirm_new_password" class="form-group">

        <input name="confirm_new_password" id="confirm_new_password" class="form-control btn-pill" placeholder="Confirm New Password" type="text">
        <small class="text-danger form-feedback" id="confirm_new_password_"></small>
      </div>

        <input name="update_password" id="update_password" type="submit" class="btn-small btn-settings-modal btn-pill" value="Save changes">

      
    </form>

    <hr>
    <div class="text-center">

        <a id="delete_account"><div class="btn btn">Delete Account</div></a>
    </div>

                                    </div>







                                    </div>

                                </ul>
                        </div>
                    </div>
                </div>
            </div>            




            <div class="modal fade" id="notifications" tabindex="-1" role="dialog" aria-labelledby="notifications" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Notifications</h4>
                        </div>

                        <div class="modal-body">
                            <div class="modal-body-scroller">

                                <div>
                                    <ul class="list-group media-list media-list-stream">

                                        <li class="list-group-item media p-a">
                                            <div class="media-left">
                                                <span class="icon icon-globe text-muted"></span>
                                            </div>

                                            <div class="media-body">
                                                <small class="pull-right text-muted">1 min</small>
                                                <div class="media-heading">
                                                    <a href="#"><strong>Jihad Ali</strong></a> went traveling
                                                </div>

                                            </div>
                                        </li>

                                        <li class="list-group-item media p-a">
                                            <div class="media-left">
                                                <span class="icon icon-game-controller text-muted"></span>
                                            </div>

                                            <div class="media-body">
                                                <small class="pull-right text-muted">3 min</small>
                                                <div class="media-heading">
                                                    <a href="#"><strong>John Smith</strong></a> played destiny
                                                </div>

                                            </div>
                                        </li>

                                        <li class="list-group-item media p-a">
                                            <div class="media-left">
                                                <span class="icon icon-user text-muted"></span>
                                            </div>

                                            <div class="media-body">
                                                <small class="pull-right text-muted">34 min</small>
                                                <div class="media-heading">
                                                    <a href="#"><strong>Fat</strong></a> and <a href="#"><strong>1 other</strong></a> followed you
                                                </div>
                                                <ul class="avatar-list">
                                                    <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                        <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                </ul>
                                            </div>
                                            </li>

                                            <li class="list-group-item media p-a">
                                                <div class="media-left">
                                                    <span class="icon icon-camera text-muted"></span>
                                                </div>

                                                <div class="media-body">
                                                    <small class="pull-right text-muted">3 min</small>
                                                    <div class="media-heading">
                                                        <a href="#"><strong>Jihad Ali</strong></a> uploaded a photo
                                                    </div>

                                                    <div class="media-body-inline-grid" data-grid="images">
                                                        <img style="display: none" data-width="640" data-height="640" data-action="zoom" src="../assets/img/instagram_3.jpg">
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item media p-a">
                                                <div class="media-left">
                                                    <span class="icon icon-flag text-muted"></span>
                                                </div>

                                                <div class="media-body">
                                                    <small class="pull-right text-muted">3 min</small>
                                                    <div class="media-heading">
                                                        <a href="#"><strong>John Smith</strong></a> flagged your post
                                                    </div>

                                                    <div class="panel panel-default m-t">
                                                        <div class="panel-body">
                                                            <div class="media">
                                                                <a class="media-left" href="#">
                                                                    <img class="media-object img-circle" src="../assets/img/avatar.png">
                                                                </a>
                                                                <div class="media-body">
                                                                    <div class="media-body-text">
                                                                        <div class="media-heading">
                                                                            <small class="pull-right text-muted">1 hr</small>
                                                                            <h5 class="m-b-0">Jane smith</h5>
                                                                        </div>
                                                                        Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-group-item media p-a">
                                                <div class="media-left">
                                                    <span class="icon icon-heart text-muted"></span>
                                                </div>

                                                <div class="media-body">
                                                    <small class="pull-right text-muted">4 hr</small>
                                                    <div class="media-heading">
                                                        <a href="#"><strong>John Smith</strong></a> and <a href="#"><strong>2 others</strong></a> favorited your post
                                                    </div>
                                                    <ul class="avatar-list">
                                                        <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                            <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                                <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                    </ul>
                                                </div>
                                                </li>

                                                <li class="list-group-item media p-a">
                                                    <div class="media-left">
                                                        <span class="icon icon-user text-muted"></span>
                                                    </div>

                                                    <div class="media-body">
                                                        <small class="pull-right text-muted">30 min</small>
                                                        <div class="media-heading">
                                                            You followed <a href="#"><strong>Jane smith</strong></a> and <a href="#"><strong>1 other</strong></a>
                                                        </div>

                                                        <div class="m-t">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="panel panel-default panel-profile">
                                                                        <div class="panel-heading" style="background-image: url(../assets/img/instagram_4.jpg);"></div>
                                                                        <div class="panel-body text-center">
                                                                            <img class="panel-profile-img" src="../assets/img/avatar.png">

                                                                            <h5 class="panel-title">Jane smith</h5>
                                                                            <p class="m-b-md">Big belly rude boy, million dollar hustler. Unemployed.</p>

                                                                            <button class="btn btn-primary-outline btn-sm">
                                                                                <span class="icon icon-add-user"></span> Follow
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="panel panel-default panel-profile">
                                                                        <div class="panel-heading" style="background-image: url(../assets/img/instagram_1.jpg);"></div>
                                                                        <div class="panel-body text-center">
                                                                            <img class="panel-profile-img" src="../assets/img/avatar.png">

                                                                            <h5 class="panel-title">John Smith</h5>
                                                                            <p class="m-b-md">GitHub and Bootstrap. Formerly at Twitter. Huge nerd.</p>

                                                                            <button class="btn btn-primary-outline btn-sm">
                                                                                <span class="icon icon-add-user"></span> Follow
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="list-group-item media p-a">
                                                    <div class="media-left">
                                                        <span class="icon icon-cog text-muted"></span>
                                                    </div>

                                                    <div class="media-body">
                                                        <small class="pull-right text-muted">30 min</small>
                                                        <div class="media-heading">
                                                            <a href="#"><strong>Jane smith</strong></a> and <a href="#"><strong>1 other</strong></a> updated their settings
                                                        </div>
                                                        <ul class="avatar-list">
                                                            <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                                <li class="avatar-list-item"><img class="img-circle" src="../assets/img/avatar.png">
                                                        </ul>
                                                    </div>
                                                    </li>

                                                    <li class="list-group-item media p-a">
                                                        <div class="media-left">
                                                            <span class="icon icon-creative-commons-noncommercial-us text-muted"></span>
                                                        </div>

                                                        <div class="media-body">
                                                            <small class="pull-right text-muted">1 min</small>
                                                            <div class="media-heading">
                                                                <a href="#"><strong>Jane smith</strong></a> quit his job
                                                            </div>

                                                        </div>
                                                    </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>







    <script>
function modal_conversations() {
$("#msgModalBody").load("external/modal_conversations.inc.php");
}
modal_conversations();

function conversation($id) {
$("#msgModalBody").load("external/modal_chat.inc.php", {id: $id});

}




      </script>

        </body>

        </html>


