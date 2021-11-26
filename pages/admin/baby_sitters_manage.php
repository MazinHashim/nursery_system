
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Admin");
$baby_sitters_manage = true;
include("../included/header.php");

if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_price = $_POST["search_price_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_price = $ser_price?"||price=$ser_price":"";
  $ser_name = $ser_name?"||username like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_price$ser_name";
  $sitter_set = Controller::db_get_baby_sitters(true, false, !empty($search_pram)?"(". substr($search_pram, 2) .")":null);
} else {
  $sitter_set = Controller::db_get_baby_sitters(true, false, null);
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
                  <input pattern="[^'\x22]+" placeholder="Name" type="text" name="search_name_value" class="rounded-0 border form-control-sm">
                  <input placeholder="Price" name="search_price_value" class="rounded-0 border form-control-sm" type="number" pattern="^[1-9][0-9]*" title="Enter only digits">
                  <input pattern="[^'\x22]+" title="invalid input" placeholder="Address" type="text" name="search_address_value" class="rounded-0 border form-control-sm">
                  <div class="input-group-append">
                      <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                  </div>
              </div>
          </form>
        </div>
        <?php
        if($sitter_set->num_rows != 0){
          while($row = mysqli_fetch_assoc($sitter_set)) {
            if(isset($row['nur_id']) && $row['accepted']){
              $query = "SELECT name FROM nursery WHERE id={$row['nur_id']} LIMIT 1";
              $nursery = Controller::db_get_Foreign_id($query);
            }
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
          <div class="our-team">
            <div class="picture">
              <img style="height:100%" class="img-fluid" src="<?=$row['img']??0 ? "../../upload/babysitter/{$row['img']} ":"../../images/user.png"?>">
            </div>
            <div class="team-content">
              <h3 class="name"><?= $row['username'] ?></h3>
              <h4 class="title"><?= $row['rule'] ?></h4>
              <h4 class="title"><?= $nursery["name"]??"No Nursery Associated" ?></h4>
              <h4 class="small text-primary"><?=!$row['accepted']?"Because It's Not Accepted Yet":"" ?></h4>

              <a type="button" class="btn btn-danger btn-sm" href="../../controller/admin_controller.php?del_sitter_id=<?= $row['id'] ?>">UnAuthorize</a>
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

<?php include("../included/footer.php"); ?>