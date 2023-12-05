<?php

include 'Backend/templates.php';
include 'Backend/functions.php';
@session_start();
redirectIfNotLoggedIn();


$msg = '';

if(isset($_FILES['profile-image'])) {

  $targetDir = "multimedia/";

  $image_path = $targetDir . basename($_FILES['profile-image']['name']);

  if(!empty($_FILES['profile-image']['tmp_name']) && getimagesize($_FILES['profile-image']['tmp_name'])) {

    if($_FILES['profile-image']['size'] > 500000) {
      $msg = 'Image too large';
    }
    else {
      move_uploaded_file($_FILES['profile-image']['tmp_name'], $image_path);

      if(isset($_SESSION['info']['profile_image'])) {
        //existing image
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare('UPDATE multimedia SET file_path = ? WHERE user_id = ?');
        $stmt->execute([$image_path, $_SESSION['info']['id']]);
        $_SESSION['info']['profile_image'] = $image_path;
        $pdo = null;
        $stmt->closeCursor();
      }else{
        //new image
        $pdo = pdo_connect_mysql();
        $stmt = $pdo->prepare('INSERT INTO multimedia (file_path, user_id) VALUES (?, ?)');
        $stmt->execute([$image_path, $_SESSION['info']['id']]);
        $_SESSION['info']['profile_image'] = $image_path;
        $pdo = null;
        $stmt->closeCursor();
      }
      
    }
  
  }else{
    $msg = 'Please upload an image';
  
  }
}

$img = fetchImg();

?>

<?= template_header('Profile', 'Profile ', $img) ?>


<div class="profile">

  <div class ="header">

    <div class="profile-image">
    <?php if (isset($_SESSION['info']['profile_image'])) : ?>
      <img src="<?php echo $_SESSION['info']['profile_image']; ?>">
    <?php else : ?>
      <img src="images/no_profile.png">   
    <?php endif; ?>
    </div>
    <div class="form">
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <div class="upload-img">
          <input type="file" accept="image/* "name="profile-image" id="profile-image">
          <input type="submit" value="Upload">
        </div>
      </form>
    </div>

    <h2 class="username">
      Hi! <?= $_SESSION['info']['username'] ?>
    </h2>

    <p class="additional-info">
      <span class="email">Email: <?= $_SESSION['info']['email'] ?></span>
    </p>
    
    <p>
      <?= $msg ?>
    </p>
  </div>
  
</div>
<?= template_footer() ?>