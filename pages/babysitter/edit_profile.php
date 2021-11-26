
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Baby Sitter");
$edit_profile = true;
include("../included/profile_header.php");

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            <section class="tab-pane" id="v-pills-settings" >
            <form action="../../controller/sitter_parent_cotroller.php" method="post" enctype="multipart/form-data" class="form-horizontal mystyle">
                <div class="picture-containers">
                    <div class="pictures">
                        <img style="height:100%" src="<?=$user['img']??0 ? "../../upload/babysitter/{$user['img']} ":"../../images/user.png"?>" class="pictures-src" id="wizardPicturePreview" title="">
                        <input type="file" id="wizard-picture" name="img" class="">
                        <input hidden type="text" value="<?=$user['img']??null?>" name="img">
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
                        <input required class="form-control" name="phone"value="<?=$user['phone']??""?>" id="phone" placeholder="05********" type="phone" pattern="[0][5][0-9]{8}" title='Enter valid phone number contains 10 digits begin with 05'>
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="address" id="address" value="<?=$user['address']??""?>" placeholder="Address" type="text">
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="price" class="col-sm-2 control-label">Price</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="price" id="price" value="<?=$user['price']??""?>" placeholder="Price" type="number" pattern="^[1-9][0-9]*" title="Enter only number">
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="work_h" class="col-sm-2 control-label">Work Hours</label>

                    <div class="col-sm-10">
                        <input required class="form-control" name="work_h" id="work_h" value="<?=$user['work_hours']??""?>" placeholder="00:00xx - 00:00xx" type="text" pattern="[0-1][0-9]:[0-5][0-9](am|pm) - [0-1][0-9]:[0-5][0-9](am|pm)">
                    </div>
                </div>
                <div class="form-group" style="padding-left: 100px;">
                    <label for="certificate" class="col-sm-2 control-label">Certificate</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="certificate" name="certificate" value="<?=$user['certif']??""?>" placeholder="" type="file">
                        <input hidden type="text" value="<?=$user['certif']??""?>" name="certificate">
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