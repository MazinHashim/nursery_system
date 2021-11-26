
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Baby Sitter");
$profile_view = true;
include("../included/profile_header.php");

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
                                <div class="card ">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong class="text-dark font-weight-bold">Skills Information</strong></li>
                                        <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Price</strong> <span class="float-right s-12"><?=$user['price']??"Not Determined" ?> </span></li>
                                        <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Work Hours</strong><span class="float-right s-12"><?=$user['work_hours']??"Not Determined" ?></span></li>
                                        <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Experience certificate</strong> <span class="float-right s-12"><?=$user['certif']?"<a href='upload/{$user['certif']}' target='_blank'>certificate.pdf</a>":"Not Determined" ?> </span></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
<?php include("../included/profile_footer.php"); ?>