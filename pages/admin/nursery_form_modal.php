<?php 
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Admin");
$nursery_manage = true;
include("../included/header.php");
if(isset($_GET['edit_nur_id'])){
  $btnTitle = "EDIT";
  $query = "SELECT * FROM nursery WHERE id={$_GET['edit_nur_id']}";
  $nur_set = Controller::db_get_Foreign_id($query);
} else {
  $btnTitle = "SAVE";
}
$mng_set = Controller::db_get_nurseries_managers(false,null);

?>  
<div class="tab-content" id="v-pills-settings-tab">
  <section>
    <br><br>
      <div class="container">
        <div class="row">
        <div class="col-md-6 m-auto">
        <form action="../../controller/admin_nursery_controller.php" method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <input hidden type="text" name="nur_id" value="<?=$nur_set['id']??''?>" class="form-control">
                <input hidden type="text" name="rule" value="<?=$user['rule']??''?>" class="form-control">
                <label for="nur_name" class="col-md-6">Nursery Name *</label>
                <input required type="text" name="nur_name" value="<?=$nur_set['name']??''?>" class="form-control" id="nur_name" style="background-color: lavender;">
                <!-- <label for="nur_address" class="col-md-6">Nursery address *</label>
                <input required type="text" name="nur_address" value="<?=$nur_set['address']??''?>" class="form-control" id="nur_address" style="background-color: lavender;">
                <label for="num_of_ch" class="col-md-6">Number of children *</label>
                <input pattern="^[1-9][0-9]*" title="Enter only number not starting with 0" required type="text" name="num_of_ch" value="<?=$nur_set['num_of_children']??''?>" class="form-control" id="num_of_ch" style="background-color: lavender;">
                <label class="col-md-12">Need For Baby Sitter ? *</label>
                <div class="form-check col-md-2 ml-4">
                  <input required class="form-check-input" type="radio" name="need_sitter" id="need_sitter_yes" value="1" <?=(($nur_set['need_babysitter']??'') == '1')?"checked":""?>>
                  <label class="form-check-label" for="need_sitter_yes">Yes</label>
                </div>
                <div required class="form-check col-md-2 ml-4">
                  <input class="form-check-input" type="radio" name="need_sitter" value="0" id="need_sitter_no" <?=(($nur_set['need_babysitter']??'') == '0')?"checked":""?>>
                  <label class="form-check-label" for="need_sitter_no">No</label>
                </div>
                <label for="t_of_w" class="col-md-12">time of work *</label>
                <input pattern="[0-1][0-9]:[0-5][0-9](am|pm) - [0-1][0-9]:[0-5][0-9](am|pm)" required type="text" name="t_of_w" value="<?=$nur_set['time_of_work']??''?>" class="form-control" id="t_of_w" style="background-color: lavender;"> -->
                <div class="form-group col-md-12">
                  <label for="nur_mng">Nursery Manager *</label>
                  <select required id="nur_mng" name="manager_id" class="form-control">
                  <?php
                  echo isset($nur_set['manager_id'])?"<option value='{$nur_set['manager_id']}'>Manager Number {$nur_set['manager_id']}</option>":"";
                    if($mng_set->num_rows != 0){
                      while($row = mysqli_fetch_assoc($mng_set)) {

                  ?>
                      <option value="<?= $row['id'] ?>"><?= $row['username'] ?></option>
                <?php }
                    } ?>
              </select>
              <?php if($mng_set->num_rows == 0) { ?>
                  <p class="text-danger"><i class="fa fa-close"></i> No Other Nursery Manager Please Add One</p>
              <?php } ?>
                </div>
                <!-- <label class="mr-5" for="img_file">Image of Nursery *</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                  <input type="file" name="img" class="form-control-file" id="img_file">
                  <input hidden type="text" name="img" value="<?=$nur_set['image']?>">
                  <?=isset($nur_set['image'])?"<img alt='No Image' class='img-fluid img-thumbnail rounded' src='../../upload/nursery/{$nur_set['image']}' style='height: 40px; width= 40px;'>":
                      '<label class="custom-file-label" for="img_file">Choose Image</label>'?>
                  </div>
                </div> -->
              </div>
              <br />
              <input type="submit" class="btn btn-block font-weight-bold btn-info" name="<?=isset($nur_set)?"edit":"add"?>_nursery" value="<?=isset($nur_set)?"EDIT":"SAVE"?>"/>
        </form>
        </div>
        </div>
      </div>
  </section>
</div>

<?php include("../included/footer.php"); ?>