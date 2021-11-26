
<?php $notif_set = Controller::db_get_notification_data(true, $user['id'], $user['rule']); ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- <link rel="icon" href="../../assets/img/basic/favicon.ico" type="image/x-icon"> -->
    <title><?=$user["rule"]?> Page</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/profile-image.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="stylesheet" href="../../css/cards.css">
    <link rel="stylesheet" href="../../css/profile.css">

    <link rel='stylesheet' href='../../plugins/font-awesome-new/css/font-awesome.min.css' type='text/css' media='all' />


</head>
<body class="light sidebar-mini sidebar-collapse">
<nav class="navbar navbar-expand-lg navbar-light bg-light white shadow" >
          <div class="container-fluid">

            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                <div class="dropdown">
                    <button class="nav-link btn fa fa-bell dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Notifications
                      <?= ($notif_set->num_rows != 0 ? "<span class='badge badge-pill badge-primary'>{$notif_set->num_rows}</span>":"") ?>
                    </button>
                    <div class="dropdown-menu shadow-lg" aria-labelledby="dropdownMenuButton">
                        <?php
                        while ($row = mysqli_fetch_assoc($notif_set)) {
                            $query = "";
                            if(isset($row['nur_id'])){
                                $query = "SELECT * FROM nursery WHERE id={$row['nur_id']} LIMIT 1";
                            } else {
                                $query = "SELECT id, username, aes_decrypt(email, 'passkey') as email, aes_decrypt(pass, 'passkey') as pass, aes_decrypt(phone, 'passkey') as phone, isVerified, rule, address, work_hours, price, certif, img, accepted, nur_id, sitter_id
                                FROM users WHERE id=(SELECT id FROM users WHERE sitter_id={$user['id']} && rule='Parent' LIMIT 1)";
                            }
                            $sender = Controller::db_get_Foreign_id($query);
                          ?>
                          <div class="media" style="width: 350px">
                            <?php if(isset($row['nur_id'])){ ?>
                                <img style="width: 45px; height:45px" class="mx-3 img-thumbnail rounded-circle" src="<?=$sender['image']??0 ? "../../upload/nursery/{$sender['image']} ":"../../images/user.png"?>" alt="<?= "{$sender['name']}" ?>">
                            <?php } else { ?>
                                <img style="width: 45px; height:45px" class="mx-3 img-thumbnail rounded-circle" src="<?=$sender['img']??0 ? "../../upload/".($row['notf_of'] != "Parent"?"user":"babysitter")."/{$sender['img']} ":"../../images/user.png"?>" alt="<?= "{$sender['username']}" ?>">
                            <?php } ?>
                            <div class="media-body">
                              <strong style="font-size:14px; font-weight:bold" class="mt-0"><?= $sender['name']??$sender['username'] ?> </strong><br>
                              <div style="font-size:10px;"><?=$row['description']?></div>
                              <?php if(!isset($row['nur_id']) && $user['rule'] == "Baby Sitter") {?>
                                <div class="justify-content-between pt-1">
                                    <button type="button" class="btn btn-outline-primary btn-sm p-1" data-rule="<?=$sender['rule']?>" data-phone="<?=$sender['phone']?>" data-address="<?=$sender['address']?>" data-name="<?=$sender['username']?>" data-toggle="modal" data-target="#moreModal">Show</button>
                                    <a class="btn btn-success btn-sm p-1" href="../../controller/sitter_parent_cotroller.php?sitter_name=<?=$user['username']?>&parent_id=<?=$sender['id']?>&ntf_id=<?=$row['notf_id']?>">Accept</a>
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="dropdown-divider mt-1"></div>
                        <?php }
                         if($notif_set->num_rows != 0){
                          echo "<a href='../../controller/sitter_parent_cotroller.php?clear_ntf_uid={$user['id']}&clear_ntf_rule={$user['rule']}' class='fa fa-trash-o p-3 nav-link'> Clear all</a>";
                        } ?>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-home" href="../index.php"> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fa fa-sign-out" href="../../controller/admin_controller.php?outMe=true"> Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
        <header class="white pt-3 relative shadow">
            <div class="container-fluid">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <div class="pb-3">
                            <div class="image mr-3  float-left">
                                <img style="width:60px;height:60px" class="user_avatar no-b no-p" src="<?=$user['img']??0 ? "../../upload/".($user['rule']=='Parent'?'user':'babysitter')."/{$user['img']} ":"../../images/user.png"?>" alt="User Image">
                            </div>
                            <div>
                                <h6 class="p-t-10"><?=$user['username']?></h6>
                                <?=$user['email']?>
                            </div>
                        </div>
                    </div>
                </div>

              <div class="row">
              <?php if($user["rule"] == "Parent"){
                    $badge_count = Controller::db_get_unread_reports_counts($user['id']);
                    $report_set = Controller::db_get_reports_data($user['id']);
                    ?>
                  <ul class="nav nav-material responsive-tab" id="v-pills-tab">
                      <li>
                          <!-- <a class="nav-link active" id="v-pills-tab1-tab" data-toggle="pill" href="#v-pills-tab1" role="tab" aria-controls="v-pills-tab1"> -->
                          <a class="nav-link <?=($profile_view?"active":"")?>" id="v-pills-tab1-tab" href='../user/profile_view.php'>
                              <i class="icon icon-home2"></i>Profile
                          </a>
                      </li>
                      <li>
                          <a class="nav-link <?=($show_nursery?"active":"")?>" id="v-pills-timeline-tab" href="../user/show_nursery.php"><i class="icon icon-cog"></i>Show Nurserys</a>
                        </li>
                        <li>
                            <a class="nav-link <?=($baby_sitter_tab?"active":"")?>" id="v-pills-settings-tab" href="../user/baby_sitter_tab.php"><i class="icon icon-cog"></i>Request Babysitters</a>
                        </li>
                        <li>
                            <a class="nav-link <?=($report_tab?"active":"")?>" id="v-pills-payments-tab" href="../../controller/sitter_parent_cotroller.php?parent_repo_read_id=<?=$user["id"]?>"><i class="icon icon-money-1"></i>Reports <?=($badge_count != 0 ? "<span class='badge badge-pill badge-primary'>{$badge_count}</span>":"")?></a>
                        </li>
                        <li>
                            <a class="nav-link <?=($children_tab?"active":"")?>" id="v-add-child-tab" href="../user/children_tab.php"><i class="icon icon-cog"></i>Your Children</a>
                        </li>
                      <li>
                          <a class="nav-link <?=($edit_profile?"active":"")?>" id="v-pills-settings-tab" href="../user/edit_profile.php"><i class="icon icon-cog"></i>Edit Profile</a>
                      </li>
                  </ul>
                  <?php } else if($user["rule"] == "Baby Sitter"){ ?>
                    <ul class="nav nav-material responsive-tab" id="v-pills-tab">
                      <li>
                          <a class="nav-link <?=($profile_view?"active":"")?>" id="v-pills-tab1-tab" href="../babysitter/profile_view.php">
                              <i class="icon icon-home2"></i>Profile
                          </a>
                      </li>
                      <li>
                          <a class="nav-link <?=($show_nursery?"active":"")?>" id="v-pills-timeline-tab" href="../babysitter/show_nursery.php"><i class="icon icon-cog"></i>Show Nurserys</a>
                        </li>
                      <li>
                          <a class="nav-link <?=($edit_profile?"active":"")?>" id="v-pills-settings-tab" href="../babysitter/edit_profile.php"><i class="icon icon-cog"></i>Edit Profile</a>
                      </li>
                  </ul>
                  <?php } ?>
              </div>
            </div>
        </header>
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