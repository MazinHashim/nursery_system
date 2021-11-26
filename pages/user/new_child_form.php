
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$children_tab = true;
include("../included/profile_header.php");
$title = "SEND";
if(isset($_GET["edit_child_id"])){
  $title = "EDIT";
  $query = "SELECT * FROM children WHERE id={$_GET["edit_child_id"]}";
  $child = Controller::db_get_Foreign_id($query);
}

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            <section class="tab-pane" id="new-child-form">
            <div class="card row">
                <div class="col-md-5 m-auto card-body" >
                  <form action="../../controller/sitter_parent_cotroller.php" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="c_name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-12">
                            <input pattern="^[a-zA-Z]*" title="Enter Characters only" value="<?=($child['name']??"")?>" required name="c_name" class="form-control" id="c_name" placeholder="Name" type="text">
                            <input pattern="^[1-9][0-9]*" title="Enter digits only" value="<?=($child['id']??"")?>" hidden name="cid" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age" class="col-sm-2 control-label">Age</label>

                        <div class="col-sm-12">
                            <input value="<?=($child['age']??"")?>" required name="age" class="form-control" id="age" placeholder="Age" type="number" pattern="^[1-9][0-9]*" title="Enter only number">
                        </div>
                        <input required name="nur_id" hidden value="<?=($child['nur_id']??$_GET['nur_id'])?>" class="form-control" type="text">
                        <input required name="uid" hidden value="<?= $user['id']?>" class="form-control" type="text">
                    </div>
                    <input type="submit" class="col-md-12 btn btn-info" name="<?=(isset($_GET["edit_child_id"])?"edit_child_btn":"add_child_btn")?>" value="<?=$title?>">
                  </form>
                </div>
              </div>
            </section>
              
           </div>
       </div>
<?php include("../included/profile_footer.php"); ?>