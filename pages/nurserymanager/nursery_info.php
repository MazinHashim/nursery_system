<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
$nursery_info = true;
include("../included/header.php");
$query = "SELECT * FROM nursery WHERE manager_id={$user['id']}";
$nur_set = Controller::db_get_Foreign_id($query);

?>

        <div class="tab-content" id="v-pills-settings-tab">
          <div class="container-fluid my-3">
              <div class="d-flex row">
                  <div class="col-md-12">
                    <div class="card mb-3 shadow no-b r-0">
                      <div class="card-header white">
                          <h6>Update nursery info</h6>
                      </div>
                      <div class="card-body">
                          <form action="../../controller/admin_nursery_controller.php" method="post" enctype="multipart/form-data">
                          <input hidden value="<?=$nur_set['manager_id']?>" type="text" name="manager_id" />
                            <input hidden type="text" name="rule" value="<?=$user['rule']??''?>" class="form-control">
                          <input hidden value="<?=$nur_set['id']?>" type="text" name="nur_id" />
                              <div class="picture-containers">
                                <div class="pictures">
                                    <img style="height:100%" src="<?=$nur_set['image']??0 ? "../../upload/nursery/{$nur_set['image']} ":"../../images/user.png"?>" class="pictures-src" id="wizardPicturePreview" title="">
                                    <input type="file" id="wizard-picture" name="img" class="">
                                    <input hidden type="text" value="<?=$nur_set['image']??""?>" name="img">
                                </div>
                                <h6 class="">Choose Picture</h6>
                            </div><br>
                              <div class="form-row">
                                  <div class="col-md-3 mb-3">
                                      <label for="nur_name">Nursery Name</label>
                                      <input class="form-control" id="nur_name" name="nur_name" placeholder="Name" value="<?=$nur_set['name']?>" required>
                                      <div class="valid-feedback">
                                          Looks good!
                                      </div>
                                  </div>
                                  <div class="col-md-5 mb-3">
                                    <label for="max_num">Maximum Number of children</label>
                                    <div class="input-group">
                                        <input type="number" pattern="^[1-9][0-9]*" title="Enter only digits" class="form-control" id="max_num" name="max_num" placeholder="Maximum Number of children" value="<?=$nur_set['maximum']??""?>" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text text-light <?=($nur_set['num_of_children']>=$nur_set['maximum']?"bg-danger":"bg-success")?>"><?=$nur_set['num_of_children']?></span>
                                        </div>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                      <label for="num_of_ch">Number of children</label>
                                      <div class="input-group">
                                      <input pattern="^[1-9][0-9]*" title="Enter only digits number" class="form-control" id="num_of_ch" name="num_of_ch" placeholder="number of children" value="<?=$nur_set['num_of_children']?>" required>
                                        <div class="input-group-append">
                                            <a href="../../controller/admin_nursery_controller.php?decrease_child_num=<?=$nur_set['id']?>" class="input-group-text text-dark"><i class="fa fa-user"></i><i class="fa fa-trash"></i></a>
                                        </div>
                                      </div>
                                      <div class="valid-feedback">
                                          Looks good!
                                      </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                      <label for="t_of_w">Time of Work</label>
                                      <input class="form-control" id="t_of_w" name="t_of_w" placeholder="00:00xx - 00:00xx" value="<?=$nur_set['time_of_work']?>" pattern="[0-1][0-9]:[0-5][0-9](am|pm) - [0-1][0-9]:[0-5][0-9](am|pm)" required>
                                      <div class="invalid-feedback">
                                          Please provide a valid state.
                                      </div>
                                  </div>
                              </div>
                              <div class="form-row">
                                  <div class="col-md-4 mb-3">
                                      <label for="price">Price</label>
                                      <input type="number" pattern="^[1-9][0-9]*" title="Enter only digits" class="form-control" id="price" name="price" placeholder="Price" value="<?=$nur_set['price']??""?>" required>
                                      <div class="invalid-feedback">
                                          Please provide a valid city.
                                      </div>
                                  </div>
                                  <div class="col-md-4 mb-3">
                                      <label for="nur_address">Nursery Address</label>
                                      <input class="form-control" id="nur_address" name="nur_address" placeholder="Address" value="<?=$nur_set['address']?>" required>
                                      <div class="valid-feedback">
                                          Looks good!
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                    <label class="col-md-8">Need For Baby Sitter ?</label>
                                    <div class="col-md-2 ml-4">
                                        <input required class="form-check-input" type="radio" name="need_sitter" id="need_sitter_yes" value="1" <?=(($nur_set['need_babysitter']??'') == '1')?"checked":""?>>
                                        <label class="form-check-label" for="need_sitter_yes">Yes</label>
                                    </div>
                                    <div class="col-md-2 ml-4">
                                        <input required class="form-check-input" type="radio" name="need_sitter" value="0" id="need_sitter_no" <?=(($nur_set['need_babysitter']??'') == '0')?"checked":""?>>
                                        <label class="form-check-label" for="need_sitter_no">No</label>
                                    </div>
                                  </div>
                              </div>
                              <div style="text-align: center;">
                                <input class="btn btn-info" type="submit" name="edit_nursery" value="Update info" />
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