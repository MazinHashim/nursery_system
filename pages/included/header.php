<?php
require_once "../../controller/db_operations.php";
if($user['rule'] == "Admin"){
  $user_set = Controller::db_get_unVerified_data();
} else {
  $query = "SELECT id FROM nursery WHERE manager_id={$user['id']}";
  $nur_set = Controller::db_get_Foreign_id($query);
  $notif_set = Controller::db_get_notification_data(false, $nur_set['id'], null);
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title><?=$user["rule"]?> Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' href='../../css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/superfish/css/superfish.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/dl-menu/component.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/font-awesome-new/css/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/elegant-font/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/fancybox/jquery.fancybox.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../plugins/flexslider/flexslider.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/style-responsive.css' type='text/css' media='all' />
    <!-- <link rel='stylesheet' href='css/style-custom.css' type='text/css' media='all' /> -->
    <link rel='stylesheet' href='../../plugins/masterslider/public/assets/css/masterslider.main.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/master-custom.css' type='text/css' media='all' />
    <link rel="stylesheet" href="../../css/profile-image.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/style1.css">
    <link rel="stylesheet" href="../../css/cards.css">
    <link rel="stylesheet" href="../../css/app.css">

    
    
  </head>
  <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
        <form action="../../controller/admin_controller.php" method="post" enctype="multipart/form-data">
          <div class="picture-containers">
            <div class="pictures">
              <img style="width:106px;height:106px" src="<?=$user['img']??0 ? "../../upload/user/{$user['img']} ":"../../images/user.png"?>" class="pictures-src" id="profilePicturePreview" title="">
              <input id="profile-picture" type="file" name="upload_user_img" />
              <input hidden value="<?=$user['img']?>" type="text" name="upload_user_img" />
            </div>
          </div>
          <!-- <input required class="img logo rounded-circle mb-2" type="file" name="upload_user_img" style="border: solid 3px white; background-image: url(<?=$user['img']??0 ? "../../upload/user/{$user['img']} ":"../../images/user.png"?>);" /> -->
          <p style="font-family: 'Arial Narrow', Arial, sans-serif" class="lead text-center">Welcome <?= $user['username'] ?></p>
          <input value="<?=$user['id']?>" name="user_id" type="text" hidden>
          <input value="<?=$user['rule']?>" name="rule" type="text" hidden>
          <input value="Upload" class="btn btn-sm btn-block btn-light" type="submit" name="upload_user_submit" />
        </form>
	        <ul class="list-unstyled components mb-5">
          <?php if($user["rule"] == "Admin"){ ?>
            <li class="<?=isset($register_user)?"active":""?>">
	            <a href="register_user.php">register user</a>
	          </li>
            <li class="<?=isset($nursery_manage)?"active":""?>">
              <a href="nursery_manage.php">Nursery</a>
            </li>
            <li class="<?=isset($nursery_manager_manage)?"active":""?>">
              <a href="nursery_manager_manage.php">Nursery manager</a>
	          </li>
	          <li class="<?=isset($baby_sitters_manage)?"active":""?>">
	              <a href="baby_sitters_manage.php">Baby sitters</a>
            </li>
	        </ul>
          
          <?php } else if($user["rule"] == "Nursery Manager"){ ?>

          <ul class="list-unstyled components mb-5">
            <li class="<?=isset($nursery_info)?"active":""?>">
	            <a href="nursery_info.php">Nursery info</a>
	          </li>
            <li class="<?=isset($babysitters)?"active":""?>">
              <a href="babysitters.php">Show babysitters</a>
	          </li>
	          <li class="<?=isset($children)?"active":""?>">
              <a href="children.php">Show children</a>
            </li>
            <li class="<?=isset($payment)?"active":""?>">
              <a href="payment.php">Payment</a>
            </li>
            <li class="<?=isset($edit_nursery_manager)?"active":""?>">
              <a href="edit_nursery_manager.php">Edit Profile</a>
            </li>
	        </ul>
          <?php } ?>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5" style="background: white;">

        <nav class="navbar navbar-expand-lg navbar-light bg-light white shadow" >
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-info">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <?php if($user['rule'] == "Admin"){?>
                    <?="<a class='btn nav-link fa fa-bell' href='../" . Controller::routeToAuthorizedPage($user['rule']) . "'> Notification ". ($user_set->num_rows != 0 ? "<span class='badge badge-pill badge-primary'>{$user_set->num_rows}</span>":"")." </a>"?>
                <?php } else {?>
                  <div class="dropdown">
                    <button class="nav-link btn fa fa-bell dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Notifications
                      <?= ($notif_set->num_rows != 0 ? "<span class='badge badge-pill badge-primary'>{$notif_set->num_rows}</span>":"") ?>
                    </button>
                    <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton">
                        <?php
                        while ($row = mysqli_fetch_assoc($notif_set)) {
                          $query1 = "SELECT id, username, aes_decrypt(email, 'passkey') as email, aes_decrypt(pass, 'passkey') as pass, aes_decrypt(phone, 'passkey') as phone, isVerified, rule, address, work_hours, price, certif, img, accepted, nur_id, sitter_id
                          FROM users WHERE id={$row['user_id']} && isVerified=true LIMIT 1";
                          $ntf_user = Controller::db_get_Foreign_id($query1);
                          $query2 = "SELECT name FROM nursery WHERE id={$row['nur_id']} LIMIT 1";
                          $ntf_nur = Controller::db_get_Foreign_id($query2);
                          ?>
                          <div class="media" style="width: 350px">
                            <img style="width: 45px; height:45px" class="mx-3 img-thumbnail rounded-circle" src="<?=$ntf_user['img']??0 ? "../../upload/". ($ntf_user['rule']=="Parent"?"user":"babysitter") ."/{$ntf_user['img']} ":"../../images/user.png"?>" alt="<?= "{$ntf_user['username']}" ?>">
                            <div class="media-body">
                              <strong style="font-size:10px;" class="mt-0"><?=$ntf_user['rule'] == "Parent" ? "Child Registration Request":"Jop Request"?></strong><br>
                              <div style="font-size:10px;"><?=$row['description']?>
                                <div class="justify-content-between pt-1">
                                  <button type="button" class="btn btn-outline-primary btn-sm p-1" data-rule="<?=$ntf_user['rule']?>" data-phone="<?=$ntf_user['phone']?>" data-address="<?=$ntf_user['address']?>" data-certificate="<?=$ntf_user['certif']?>" data-name="<?=$ntf_user['username']?>" data-toggle="modal" data-target="#moreModal">Show</button>
                                  <a class="btn btn-success btn-sm p-1" href="../../controller/nursery_manager_controller.php?<?=isset($row['child_id'])?"ntf_child_id={$row['child_id']}&":""?>ntf_nur_name=<?=$ntf_nur['name']?>&ntf_user_id=<?=$row['user_id']?>&ntf_nur_id=<?=$row['nur_id']?>&ntf_id=<?=$row['notf_id']?>">Accept</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="dropdown-divider mt-1"></div>
                        <?php }
                        if($notif_set->num_rows != 0){
                          echo "<a href='' class='fa fa-trash-o p-3 nav-link'> Clear all</a>";
                        }
                        ?>
                    </div>
                  </div>
                <?php } ?>
                </li>
                <li class="btn nav-item">
                    <a class="nav-link fa fa-home" href="../index.php"> Home</a>
                </li>
                <li class="btn nav-item">
                    <a class="nav-link fa fa-sign-out" href="../../controller/admin_controller.php?outMe=true"> Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="modal fade" id="moreModal" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="moreModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href='' target='_blank' class='btn btn-info'>View Certificate</a>
              </div>
            </div>
          </div>
        </div>
        <?php
        if(isset($_SESSION["errorMessage"])){
          echo "<div class='alert alert-danger' role='alert'>";
          echo "<b>{$_SESSION["errorMessage"]}</b>";
          $_SESSION["errorMessage"] = null;
          echo "</div>";
          }
          
          if(isset($_SESSION["infoMessage"])){ 
          echo "<div class='alert alert-info' role='alert'>";
          echo "<b>{$_SESSION["infoMessage"]}</b>";
          $_SESSION["infoMessage"] = null;
          echo "</div>";
          }
        ?>