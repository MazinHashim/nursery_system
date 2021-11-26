<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Admin");
$nursery_manager_manage = true;
include("../included/header.php");
if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_name = $ser_name?"||username like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_name";
  $mng_set = Controller::db_get_nurseries_managers(true, !empty($search_pram)?"(". substr($search_pram, 2) .")":null);
} else {
  $mng_set = Controller::db_get_nurseries_managers(true, null);
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
                  <input placeholder="Name" type="text" name="search_name_value" class="rounded-0 border form-control-sm">
                  <input placeholder="Address" name="search_address_value" class="rounded-0 border form-control-sm" type="number" pattern="^[1-9][0-9]*" title="Enter only digits">
                  <div class="input-group-append">
                      <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                  </div>
              </div>
          </form>
        </div>
        <?php
        if($mng_set->num_rows != 0){
          while($row = mysqli_fetch_assoc($mng_set)) {
            $nursery = null;
            if(isset($row['nur_id'])){
              $query = "SELECT name FROM nursery WHERE id={$row['nur_id']} LIMIT 1";
              $nursery = Controller::db_get_Foreign_id($query);
            }
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
          <div class="our-team">
            <div class="picture">
            <img class="img-fluid" style="height:100%"  src="<?=$row['img']??0 ? "../../upload/user/{$row['img']} ":"../../images/user.png"?>">
            </div>
            <div class="team-content">
              <h3 class="name"><?= $row['username'] ?></h3>
              <h4 class="title"><?= $row['rule'] ?></h4>
              <h4 class="title"><?= $nursery["name"]??"No Nursery Associated" ?></h4>

              <a type="button" class="btn btn-danger btn-sm" href="../../controller/admin_controller.php?del_mng_id=<?= $row['id'] ?>">UnAuthorize</a>
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
                    No Manager To Be Showed
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