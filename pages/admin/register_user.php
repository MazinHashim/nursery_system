<?php 
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Admin");
$register_user = true;
include("../included/header.php");
$user_set = Controller::db_get_unVerified_data();

?>  
<div class="tab-content" id="v-pills-settings-tab">
  <section>
    <br><br>
    <!-- <button type="button" class="btn btn-info btn-sm" style="margin-left: 30px;">Add new</button> -->
      <div class="container">
        <div class="row">
        <?php
        if($user_set->num_rows != 0){
          while($row = mysqli_fetch_assoc($user_set)) {
          
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="our-team">
            <div class="picture">
              <img class="img-fluid" src="../../images/user.png">
            </div>
            <div class="team-content">
              <h3 class="name"><?= $row['username'] ?></h3>
              <h4 class="title"><?= $row['rule']==="Parent"?"User": $row['rule'] ?></h4>

              <a type="button" class="btn btn-success btn-sm" href="../../controller/admin_controller.php?acceptId=<?= $row['id'] ?>">Accept</a>
              <a type="button" class="btn btn-danger btn-sm" href="../../controller/admin_controller.php?rejectId=<?= $row['id'] ?>">Reject</a>
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
                    No Users Registration Request
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