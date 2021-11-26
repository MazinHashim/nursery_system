<?php 
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
$edit_nursery_manager = true;
include("../included/header.php");
?>  
<div class="tab-content" id="v-pills-settings-tab">
  <section>
    <br><br>
    <!-- <button type="button" class="btn btn-info btn-sm" style="margin-left: 30px;">Add new</button> -->
      <div class="container">
        <div class="row">
        <div class="col-md-6 m-auto">
        <form action="../../controller/nursery_manager_controller.php" method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <input hidden type="text" name="mng_id" value="<?=$user['id']??''?>" class="form-control">
                <label for="mng_name" class="col-md-6">Manager Name *</label>
                <input required type="text" name="mng_name" value="<?=$user['username']??''?>" class="form-control" id="mng_name" style="background-color: lavender;">
                <label for="mng_address" class="col-md-6">Manager address *</label>
                <input required type="text" name="mng_address" value="<?=$user['address']??''?>" class="form-control" id="mng_address" style="background-color: lavender;">
                <label for="mng_email" class="col-md-6">Email *</label>
                <input required type="text" name="mng_email" value="<?=$user['email']??''?>" class="form-control" id="mng_email" style="background-color: lavender;">
                <label for="mng_pass" class="col-md-12">Password *</label>
                <input required type="password" name="mng_pass" value="<?=$user['pass']??''?>" class="form-control" id="mng_pass" style="background-color: lavender;" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more character">
                <label for="mng_phone" class="col-md-12">Phone *</label>
                <input required type="phone" name="mng_phone" value="<?=$user['phone']??''?>" class="form-control" id="mng_phone" style="background-color: lavender;" pattern="[0][5][0-9]{8}" title='Enter valid phone number contains 10 digits begin with 05'>
                <label class="mr-5" for="img_file">Profile Image of Nursery Manager *</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                  <input type="file" name="img" class="form-control-file" id="img_file">
                  <input hidden type="text" value="<?=$user['img']??""?>" name="img">
                  <?=isset($user['img'])?"<img alt='No Image' class='img-fluid img-thumbnail rounded' src='../../upload/user/{$user['img']}' style='height: 40px; width= 40px;'>":
                      '<label class="custom-file-label" for="img_file">Choose Image</label>'?>
                  </div>
                </div>
              </div>
              <br />
              <input type="submit" class="btn btn-block font-weight-bold btn-info" name="edit_manager_submit" value="EDIT" />
        </form>
        </div>
        </div>
      </div>
  </section>
</div>

<?php include("../included/footer.php"); ?>