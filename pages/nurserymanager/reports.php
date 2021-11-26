<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
include("../included/header.php");
$query = "SELECT id, price FROM nursery WHERE manager_id={$user['id']}";
$nur = Controller::db_get_Foreign_id($query);
?>
        </nav>
        <div class="tab-content" id="v-pills-settings-tab">
          <div class="container-fluid my-3">
              <div class="d-flex row">
                  <div class="col-md-12">
                    <div class="card mb-3 shadow no-b r-0">
                      <div class="card-header white">
                          <h6>write report</h6>
                      </div>
                      <div class="card-body">
                          <form action="../../controller/nursery_manager_controller.php" class="needs-validation" method="POST">    
                              <div class="picture-containers">
                                <div class="pictures">
                                    <img src="<?=$_GET['parent_img']??0 ? "../../upload/user/{$_GET['parent_img']} ":"../../images/user.png"?>">
                                </div>
                            </div><br>
                              <div class="form-row">
                                  <div class="col-md-6 mb-12">
                                      <label for="child_id">child id</label>
                                      <input class="form-control" id="child_id" name="repo_child_id" placeholder="Child id" value="<?=$_GET['child_id']?>" required readonly>
                                      <input required hidden name="repo_parent_id" value="<?=$_GET['parent_id']?>">
                                  </div>
                                  <div class="col-md-6 mb-12">
                                      <label for="child_name">child name</label>
                                      <input class="form-control" id="child_name" name="child_name" placeholder="Child Name" value="<?=$_GET['child_name']?>" required readonly>
                                  </div>
                                  <input hidden name="repo_nur_id" value="<?=$nur['id']?>" required>
                              </div>
                              <div class="col-md-12 mb-12">
                                <div class="form-group"><br>
                                <label for="repo_desc">Activities of child</label>

                                    <textarea required class="form-control r-12" name="repo_desc" id="repo_desc" rows="8"></textarea>
                                </div>
                              </div>
                              <div style="text-align: center;">
                                <input value="Send Report" name="save_repo_submit" class="btn btn-info" type="submit" />
                              </div>
                          </form>


                      </div>
                  </div>
                  </div>
              </div>
          </div>
        <!-- #END# Basic Validation -->
      </div>


      <?php include("../included/footer.php"); ?>