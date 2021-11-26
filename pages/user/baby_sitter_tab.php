

<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$baby_sitter_tab = true;
include("../included/profile_header.php");
if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_price = $_POST["search_price_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_price = $ser_price?"||price=$ser_price":"";
  $ser_name = $ser_name?"||username like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_price$ser_name";
  $babysitter = Controller::db_get_baby_sitters(false, false, !empty($search_pram)?"(". substr($search_pram, 2) .")":null);
} else {
  $babysitter = Controller::db_get_baby_sitters(false, false, null);
}
?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            
            <section class="tab-pane" id="babysitter" >
            <br><br>
            <?php if(isset($user["accepted"]) && $user["rule"] == "Parent"){
              $sitter = Controller::db_get_Foreign_id("SELECT username FROM users WHERE id={$user['sitter_id']} LIMIT 1");
              echo "<div class='alert alert-success' role='alert'>";
              echo $user["accepted"]?"<p class='lead'>You Have Already Accepted By <span class='font-weight-bold'>{$sitter['username']}</span></p>"
                    :"<p class='lead'>Jop request has already been sent to <span class='font-weight-bold'>{$sitter['username']}</span>, wait for acceptance</p>";
              echo "</div>";
              }?>
            <div class="container">
                    <div class="row">
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
                    if($babysitter->num_rows != 0){
                      while($row = mysqli_fetch_assoc($babysitter)) {
                    ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                      <div class="our-team">
                        <div class="picture">
                          <img class="img-fluid" src="<?=$row['img']??0 ? "../../upload/babysitter/{$row['img']} ":"../../images/user.png"?>" style="height:100%">
                        </div>
                        <div class="team-content">
                          <h3 class="name mb-3"><?= $row['username'] ?></h3>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-map-marker"></i> <?=($row['address']??"<code>Not Determined</code>") ?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-clock-o"></i> <?=($row['work_hours']??"<code>Not Determined</code>") ?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-dollar"></i> <?= "Price: " . ($row['price']?"{$row['price']} $":"<code>Not Determined</code>") ?></h4>
                          <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-certificate"></i> <?=($row['certif']?"<a href='../babysitter/upload/{$row['certif']}' target='_blank'>certificate.pdf</a>":"<code>Not Determined</code>")?></h4>
                          <!-- <h4 class="title"><?= $nursery["name"]??"No Nursery Associated" ?></h4> -->
                          
                          <!-- <?php if(!isset($row['sitter_id'])){
                            echo $row['certif'] ? "<a class='btn btn-info btn-sm' id='new-child-tab' href='../../controller/sitter_parent_cotroller.php?req_parent_name={$user['username']}&parent_req_sitter_id={$row['id']}&req_parent_id={$user['id']}'>Send Request To This Baby Sitter</a>"
                            : "<h4 class='title text-danger'>Send request after upload his certificate</h4>";
                          } else {
                            echo "<b class='text-success'><i class='fa fa-check bg-success text-light p-1 rounded-circle'></i> Sent</b>";                            
                          }
                          ?> -->
                          <?php if(!isset($user["accepted"])){
                            echo $row['certif'] ? "<a class='btn btn-info btn-sm' href='../../controller/sitter_parent_cotroller.php?req_parent_name={$user['username']}&parent_req_sitter_id={$row['id']}&req_parent_id={$user['id']}'>Send Request To This Baby Sitter</a>"
                            : "<h4 class='title text-danger'>Send request after upload his certificate</h4>";
                          } else {
                            echo $user['sitter_id'] == $row['id']?
                            "<a class='btn btn-danger mb-2 btn-sm' href='../../controller/sitter_parent_cotroller.php?req_parent_del_name={$user['username']}&parent_req_sitter_del_id={$row['id']}&req_parent_del_id={$user['id']}'>Cancel Request</a>".
                            "<br/><b class='text-success'><i class='fa fa-check bg-success text-light p-1 rounded-circle'></i> Sent</b>"
                            :"<b class='text-danger'><i class='fa fa-close bg-danger text-light p-1 rounded-circle'></i> Not Sent</b>";
                          }?>
                          <br/>
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
       </div>
<?php include("../included/profile_footer.php"); ?>