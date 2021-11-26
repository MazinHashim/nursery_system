<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
$babysitters = true;
include("../included/header.php");
if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_price = $_POST["search_price_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_price = $ser_price?"||price=$ser_price":"";
  $ser_name = $ser_name?"||username like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_price$ser_name";
  $query = "SELECT id, username, aes_decrypt(email, 'passkey') as email, aes_decrypt(pass, 'passkey') as pass, aes_decrypt(phone, 'passkey') as phone, isVerified, rule, address, work_hours, price, certif, img, accepted, nur_id, sitter_id
  FROM users WHERE (". substr($search_pram, 2) .") && nur_id=$user[nur_id] && isVerified=true && accepted=true && rule='Baby Sitter'";
} else {
  $query = "SELECT id, username, aes_decrypt(email, 'passkey') as email, aes_decrypt(pass, 'passkey') as pass, aes_decrypt(phone, 'passkey') as phone, isVerified, rule, address, work_hours, price, certif, img, accepted, nur_id, sitter_id
  FROM users WHERE nur_id=$user[nur_id] && isVerified=true && accepted=true && rule='Baby Sitter'";
}

$sitter_set = Controller::performQuery($query);

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
                            <input placeholder="Name" type="text" name="search_name_value" class="rounded-0 border form-control-sm">
                            <input placeholder="Price" name="search_price_value" class="rounded-0 border form-control-sm" type="number" pattern="^[1-9][0-9]*" title="Enter only digits">
                            <input placeholder="Address" type="text" name="search_address_value" class="rounded-0 border form-control-sm">
                            <div class="input-group-append">
                                <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if($sitter_set->num_rows != 0){
                  while($row = mysqli_fetch_assoc($sitter_set)) {
                ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="our-team">
                      <div class="picture-containers">
                        <div class="picture">
                          <img style="height:100%" src="<?=$row['img']??0 ? "../../upload/babysitter/{$row['img']} ":"../../images/user.png"?>">
                        </div>
                        <div class="team-content">
                          <h3 class="name text-dark"><?=$row['username']?></h3>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-phone"></i> <?=$row['phone']?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-map-marker"></i> <?=$row['address']??"Not Determined"?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-clock-o"></i> <?=$row['work_hours']??"Not Determined"?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-dollar"></i> Price : <?=$row['price']??"Not Determined"?></h4>
                          <a class="btn btn-danger btn-sm" href="../../controller/nursery_manager_controller.php?del_sitter_id=<?=$row['id']?>&&mng_nur_id=<?=$user['nur_id']?>&&mng_name=<?=$user['username']?>">Delete</a>
                          <br/>
                          <br/>
                        </div>
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
                    No Baby Sitter To Be Showed
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