
<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$show_nursery = true;
include("../included/profile_header.php");
if(isset($_POST["search_nur_btn"])){
  $ser_address = $_POST["search_address_value"];
  $ser_price = $_POST["search_price_value"];
  $ser_name = $_POST["search_name_value"];
  $ser_address = $ser_address?"||address like '$ser_address%'":"";
  $ser_price = $ser_price?"||price=$ser_price":"";
  $ser_name = $ser_name?"||name like '$ser_name%'":"";

  $search_pram = "$ser_address$ser_price$ser_name";
  $nur_set = Controller::db_get_all_nurseries("WHERE (". substr($search_pram, 2) .") && (maximum is null || num_of_children<maximum)");
} else {
  $nur_set = Controller::db_get_all_nurseries("WHERE maximum is null or num_of_children<maximum");
}

?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            <section class="tab-pane" id="v-pills-timeline">
              <br><br>
                <div class="container">
                <div class="row nav" id="v-pills-tab" role="tablist">
                <div class="col-12">
                    <form action="" method="POST">
                        <div class="input-group justify-content-end">
                            <input placeholder="Name" type="text" name="search_name_value" class="rounded-0 border form-control-sm">
                            <input placeholder="Price" type="number" name="search_price_value" class="rounded-0 border form-control-sm">
                            <input placeholder="Address" type="text" name="search_address_value" class="rounded-0 border form-control-sm">
                            <div class="input-group-append">
                                <input type="submit" name="search_nur_btn" class='btn btn-info btn-sm' value="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if($nur_set->num_rows != 0){
                    while ($row = mysqli_fetch_assoc($nur_set)) {
                      ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="our-team">
                        <b class="picture">
                        <img class="img-fluid" src="<?=$row['image']??0 ? "../../upload/nursery/{$row['image']} ":"../../images/user.png"?>" style="height: 100%">
                        </b>
                        <h3 class="name mb-3"><?=$row["name"]?></h3>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-map-marker"></i> <?=$row["address"]??"<code>Not Determined</code>"?></h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-dollar"></i> Price: <?=($row["price"]??"0") . "$"?></h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-child"></i> Have <?=$row["num_of_children"]??"<code>No</code>"?> Children</h4>
                        <h4 class="title text-left pl-5"><i style="font-size: 20px" class="fa fa-clock-o"></i> <?=$row["time_of_work"]??"<code>Not Determined</code>"?></h4>
                        <a class='btn col-9 btn-info btn-sm' id='new-child-tab' href='../user/new_child_form.php?nur_id=<?=$row['id']?>'>Add Child To This Nursery</a>
                        <!-- <button type="button" class="btn btn-danger btn-sm">Delete</button> -->
                        <?php
                        $query_str1 = "SELECT rating FROM user_rating WHERE nur_id={$row["id"]}";
                        $rating = Controller::performQuery($query_str1);
                        $rating_value = 0;
                        while ( $data = mysqli_fetch_assoc($rating) ) {
                          $rating_value += $data['rating'];
                        }
                        if($rating_value != 0){$rating_value = $rating_value/$rating->num_rows;}
                          ?>
                        <div class="container">
                            <div class="row p-2 bg-light shadow mt-4 justify-content-around">
                            <a href="../../controller/sitter_parent_cotroller.php?rating_value=20&nur_id=<?=$row["id"]?>&parent_id=<?=$user['id']?>"><i class='fa <?=($rating_value > 0?"fa-star":"fa-star-o")?> text-warning' style="font-size: 25px"></i></a>
                            <a href="../../controller/sitter_parent_cotroller.php?rating_value=40&nur_id=<?=$row["id"]?>&parent_id=<?=$user['id']?>"><i class='fa <?=($rating_value > 20?"fa-star":"fa-star-o")?> text-warning' style="font-size: 25px"></i></a>
                            <a href="../../controller/sitter_parent_cotroller.php?rating_value=60&nur_id=<?=$row["id"]?>&parent_id=<?=$user['id']?>"><i class='fa <?=($rating_value > 40?"fa-star":"fa-star-o")?> text-warning' style="font-size: 25px"></i></a>
                            <a href="../../controller/sitter_parent_cotroller.php?rating_value=80&nur_id=<?=$row["id"]?>&parent_id=<?=$user['id']?>"><i class='fa <?=($rating_value > 60?"fa-star":"fa-star-o")?> text-warning' style="font-size: 25px"></i></a>
                            <a href="../../controller/sitter_parent_cotroller.php?rating_value=100&nur_id=<?=$row["id"]?>&parent_id=<?=$user['id']?>"><i class='fa <?=($rating_value > 80?"fa-star":"fa-star-o")?> text-warning' style="font-size: 25px"></i></a>
                            </div>
                          </div>
                        <br/>
                        <br/>
                    </div>
                    </div>
                    <?php }
                    } else { ?>
                        <div class="container">
                        <div class="row justify-content-md-center">
                          <div class="col-md-auto font-weight-bold">
                            No Nursery Data
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                </div>
                </div>
                
              </section>
              
           </div>
       </div>
<?php include("../included/profile_footer.php"); ?>