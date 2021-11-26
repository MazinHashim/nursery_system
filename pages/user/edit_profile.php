
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$edit_profile = true;
include("../included/profile_header.php");

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            <section class="tab-pane" id="v-pills-settings" >
            <form action="../../controller/sitter_parent_cotroller.php" method="post" enctype="multipart/form-data" class="form-horizontal mystyle">
                <div class="picture-containers">
                    <div class="pictures">
                        <img style="height:100%" src="<?=$user['img']??0 ? "../../upload/user/{$user['img']} ":"../../images/user.png"?>" class="pictures-src" id="wizardPicturePreview" title="">
                        <input type="file" onload='inject_value("Mazin")' value=<?=($user['img']?"../../upload/user/{$user['img']} ":"")?> id="wizard-picture" name="img" class="">
                        <input hidden type="text" value="<?=$user['img']??""?>" name="img">
                    </div>
                        <h6 class="">Choose Picture</h6>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <input name="user_id" value="<?=$user['id']?>" hidden type="text">
                    <input name="rule" value="<?=$user['rule']?>" hidden type="text">
                    
                    <label for="username" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="username" id="username" placeholder="User Name" value="<?=$user['username']??""?>" type="text">
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="phone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="phone"value="<?=$user['phone']??""?>" id="phone" placeholder="Phone Number" type="phone" pattern="[0][5][0-9]{8}" title='Enter valid phone number contains 10 digits begin with 05'>
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="address" id="address" value="<?=$user['address']??""?>" placeholder="Address" type="text">
                    </div>
                </div>
                <div class="container"></div>
                <div class="form-group" style="padding-left: 325px;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="save_user" class="btn btn-info">Save Data</button>
                    </div>
                </div>
            </form>
            </section>
              
           </div>
       </div>
<?php include("../included/profile_footer.php"); ?>