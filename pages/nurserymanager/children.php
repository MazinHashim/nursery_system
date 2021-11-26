<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
$children = true;
include("../included/header.php");
$query = "SELECT id, price FROM nursery WHERE manager_id={$user['id']}";
$nur = Controller::db_get_Foreign_id($query);
if(isset($_POST["search_nur_btn"]) && isset($_POST["search_value"])){
  $search_pram = "(name like '{$_POST["search_value"]}%')";
  $children = Controller::db_get_accepted_children(false, $nur['id'], "$search_pram");
} else {
  $children = Controller::db_get_accepted_children(false, $nur['id'], null);
}

?>

        <div class="tab-content" id="v-pills-settings-tab">
          <section>
            <br><br>
            <!-- <button type="button" class="btn btn-info btn-sm" style="margin-left: 30px;">Add new</button> -->
              <div class="container">
                <div class="row">
                <div class="col-12">
                <form action="" method="POST">
                      <div class="input-group justify-content-end">
                          <input placeholder="Name" required type="text" name="search_value" class="border form-control-sm">
                          <div class="input-group-append">
                              <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                          </div>
                      </div>
                  </form>
                </div>
                <?php
                  if($children->num_rows != 0){
                    while($row = mysqli_fetch_assoc($children)) {
                      $query = "SELECT username, img, aes_decrypt(phone,'passkey') as phone FROM users WHERE rule='Parent' && id={$row['parent_id']}";
                      $parent = Controller::db_get_Foreign_id($query);
                  ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="our-team">
                      <div class="picture">
                        <img style="height:100%" class="img-fluid" src="<?=$parent['img']??0 ? "../../upload/user/{$parent['img']} ":"../../images/user.png"?>">
                      </div>
                      <div class="team-content">
                        <h3 class="name text-dark"><?=$row['name']?> <?=$parent['username']?></h3>
                        <h4 class="title">Child id : #<?=$row['id']?> </h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-child"></i> Child age <?=$row['age']?> </h4>
                        <h4 class="title text-success text-left pl-5"><i style="font-size: 20px" class="fa fa-credit-card"></i> <?=$row['fees']?> Paid</h4>
                        <h4 class="title text-danger text-left pl-5"><i style="font-size: 20px" class="fa fa-money"></i> <?=($nur['price'] - $row['fees']) ?> Remaining</h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-phone"></i> <?=$parent['phone']?> </h4>
                        <a href="reports.php?parent_id=<?=$row['parent_id']?>&child_id=<?=$row['id']?>&child_name=<?=$row['name']?>&parent_img=<?=$parent['img']?>" class="btn btn-info btn-sm">Write Reports</a>
                        <!-- <a href="payment.php" class="btn btn-info btn-sm">Payments</a> -->
                        <a href="../../controller/nursery_manager_controller.php?parent_id=<?=$row['parent_id']?>&&child_name=<?=$row['name']?>&&del_child_id=<?=$row['id']?>&&mng_nur_id=<?=$user['nur_id']?>&&mng_name=<?=$user['username']?>" class="btn btn-danger btn-sm">Delete</a>
                        <br/>
                      </div>
                    </div>
                  </div>
                  <?php
                    }
                  } else {
                    ?>
                    <div class="container">
                      <div class="row justify-content-md-center">
                        <div class="col-md-auto font-weight-bold">
                          No Children Registered To Be Showed
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                ?>
                </div>
              </div>
              
          </section>
      </div>


<?php include("../included/footer.php"); ?>