<?php

include("header.inc.php");

$select = "SELECT * FROM posts WHERE post_type = 'image' OR post_type = 'video' ORDER BY post_id DESC";
$select = mysqli_query($connection, $select);


while ($row = mysqli_fetch_assoc($select)) {

$post_user_id = $row['post_user_id'];
$post_content = $row['post_content'];
$post_file = $row['post_file'];
$post_type = $row['post_type'];
$post_timestamp = $row['post_timestamp'];

$select_user = "SELECT * FROM users WHERE user_id = '{$post_user_id}'";
$select_user = mysqli_query($connection, $select_user);
$row_user = mysqli_fetch_assoc($select_user);



?>

        <li class="media list-group-item p-a xs_border">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="assets/img/<?php echo $row_user['user_avatar']; ?>">
          </a>
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted"><?php echo timestamp($post_timestamp); ?></small>
              <h5><?php echo ucfirst($row_user['user_firstname']) . " " . ucfirst($row_user['user_lastname']); ?></h5>
            </div>

            <p>
              <?php echo $post_content; ?>
              
            </p>
<?php if ($post_type == "image") { ?>

            <div class="media-body-inline-grid" data-grid="images">
              <img style="max-height: 500px" src="post_files/<?php echo $post_file; ?>">
            </div>

<?php } elseif ($post_type == "video") { ?>



<video width="100%" controls>
  <source src="post_files/<?php echo $post_file; ?>" type="video/mp4">
  Your browser does not support HTML5 video.
</video>


<?php } ?>
          </div>
        </li>

        <?php } ?>
