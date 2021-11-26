
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$report_tab = true;
include("../included/profile_header.php");

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            <section class="tab-pane" id="v-pills-payments" >
            <?php
            if($report_set->num_rows != 0){
                while($row = mysqli_fetch_assoc($report_set)) {
                $nur = Controller::db_get_Foreign_id("SELECT name, image FROM nursery WHERE id={$row['nursery_id']}");
                $child = Controller::db_get_Foreign_id("SELECT name FROM children WHERE parent_id={$row['parent_id']}");
            ?>
            <div class="card my-3 no-b">
                <div class="p-3">
                    <div class="image mr-3 float-left">
                        <img class="user_avatar no-b no-p" src="<?=$nur['image']??0 ? "../../upload/nursery/{$nur['image']} ":"../../images/user.png"?>" alt="User Image">
                    </div>
                    <div>
                        <h6 class="p-t-10">From : <code><?=$nur['name']?> Nursery</code></h6>
                        <h6> To: The guardian of the child <code><?="{$child['name']} {$user['username']}"?> </code></h6>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">child activities</h5>
                    <p class="card-text"><?=$row['description']?></p>
                </div>
            </div>
            <?php
                }
                } else {
                ?>
                <div class="container">
                    <div class="row justify-content-md-center">
                    <div class="col-md-auto font-weight-bold">
                        No Reports To Be Showed
                    </div>
                    </div>
                </div>
                <?php
                }
            ?>

            </section>
              
           </div>
       </div>
<?php include("../included/profile_footer.php"); ?>