
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Baby Sitter");
$show_nursery = true;
include("../included/profile_header.php");
if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_price = $_POST["search_price_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_price = $ser_price?"||price=$ser_price":"";
  $ser_name = $ser_name?"||name like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_price$ser_name";
  $nur_set = Controller::db_get_all_nurseries("WHERE (". substr($search_pram, 2) .") && (need_babysitter=true)");
} else {
  $nur_set = Controller::db_get_all_nurseries("WHERE need_babysitter=true");
}


?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            
            <section class="tab-pane" id="v-pills-timeline">
              <br><br>
              <?php if(isset($user["accepted"]) && $user["rule"] == "Baby Sitter"){
              $nur = Controller::db_get_Foreign_id("SELECT name FROM nursery WHERE id={$user['nur_id']} LIMIT 1");
              echo "<div class='alert alert-success' role='alert'>";
              echo $user["accepted"]?"<p class='lead'>You Have Already Accepted By <span class='font-weight-bold'>{$nur['name']} Nursery</span></p>"
                    :"<p class='lead'>Jop request has already been sent to <span class='font-weight-bold'>{$nur['name']} Nursery</span>, wait for acceptance</p>";
              echo "</div>";
              }?>
              <!-- <button type="button" class="btn btn-info btn-sm" style="margin-left: 30px;">Add new</button> -->
                <div class="container">
                <div class="row nav" id="v-pills-tab" role="tablist">
                <div class="col-12">
                    <form action="" method="POST">
                        <div class="input-group justify-content-end">
                            <input placeholder="Name" type="text" name="search_name_value" class="rounded-0 border form-control-sm">
                            <input placeholder="Price" type="number" name="search_price_value" class="rounded-0 border form-control-sm">
                            <input placeholder="Address" type="text" name="search_address_value" class="rounded-0 border form-control-sm">
                            <div class="input-group-append">
                                <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if($nur_set->num_rows != 0){
                    while ($row = mysqli_fetch_assoc($nur_set)) {
                      ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="our-team">
                        <b class="picture">
                        <img class="img-fluid" src="<?=$row['image']??0 ? "../../upload/nursery/{$row['image']} ":"../../images/user.png"?>" style="height: 100%">
                        </b>
                        <h3 class="name mb-3"><?=$row["name"]?></h3>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-map-marker"></i> <?=$row["address"]?></h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-dollar"></i> Price: <?=($row["price"]??"0") . "$"?></h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-child"></i> Have <?=$row["num_of_children"]?> Children</h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-clock-o"></i> <?=$row["time_of_work"]?></h4>
                        <?php if(!isset($user["accepted"])){
                            echo $user['certif'] ? "<a class='btn btn-info btn-sm' href='../../controller/sitter_parent_cotroller.php?uname={$user['username']}&uid={$user['id']}&nur_id={$row['id']}'>Send Jop Request</a>"
                            : "<h4 class='title text-danger'>Send request after upload your certificate</h4>";
                          } else {
                            echo $user['nur_id'] == $row['id']?
                            "<a class='btn btn-danger mb-2 btn-sm' href='../../controller/sitter_parent_cotroller.php?cancel_uname={$user['username']}&cancel_uid={$user['id']}&cancel_nur_id={$row['id']}'>Cancel Request</a>".
                            "<br/><b class='text-success'><i class='fa fa-check bg-success text-light p-1 rounded-circle'></i> Sent</b>"
                            :"<b class='text-danger'><i class='fa fa-close bg-danger text-light p-1 rounded-circle'></i> Not Sent</b>";
                          }?>
                        <br/>
                        <br/>
                    </div>
                    </div>
                    <?php }
                    } else { ?>
                        <div class="container">
                        <div class="row justify-content-md-center">
                          <div class="col-md-auto font-weight-bold">
                            No Nursery Data
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                </div>
                </div>
                
              </section> 
            </div>
       </div>
        
<?php include("../included/profile_footer.php"); ?>
