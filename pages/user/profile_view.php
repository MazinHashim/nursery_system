
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$profile_view=true;
include("../included/profile_header.php");
$query = "SELECT * FROM children WHERE parent_id=$user[id] && accepted=true";
$count_children = Controller::performQuery($query);

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-tab1" >
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card ">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong class="text-dark font-weight-bold">Personal Information</strong></li>
                                        <li class="list-group-item"><i class="icon icon-mobile text-primary"></i><strong class="s-12">Phone</strong> <span class="float-right s-12"><?=$user['phone']??"Not Determined"?></span></li>
                                        <li class="list-group-item"><i class="icon icon-address-card-o text-warning"></i><strong class="s-12">Address</strong> <span class="float-right s-12"><?=$user['address']??"Not Determined"?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card p-4">
                                    <span style="font-size:60px" class="fa fa-smile-o"></span>
                                    <h5>The Total Number Of Registered Children <b class="text-white bg-primary badge"><?=$count_children->num_rows?></b></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include("../included/profile_footer.php"); ?>