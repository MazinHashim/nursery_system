

<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Parent");
$children_tab = true;
include("../included/profile_header.php");
$children = Controller::db_get_accepted_children(true, $user['id'], null);
?>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
            
            <section class="tab-pane" id="add-child">
            <div class="card my-3 no-b">
                <div class="card-body" >
                    <table id="example2" class="table table-bordered table-hover data-tables">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>age</th>
                            <th>parent phone</th>
                            <th>update</th>
                            <th>delete</th>


                        </tr>
                        </thead>
                        <tbody>
                    <?php if($children->num_rows != 0){
                        while ($row = mysqli_fetch_assoc($children)) {
                        ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['age']?></td>
                            <td><?=$user['phone']?></td>
                            <td>
                                <!-- <button type='button' class='btn btn-info btn-sm' id='new-child-tab' data-toggle='pill' href='#new-child-form' role='tab' aria-controls='add-child' aria-selected='true'>Add Child To This Nursery</button> -->
                                <a href="../user/new_child_form.php?edit_child_id=<?=$row['id']?>"><i class="fa fa-edit"></i></a>
                                </td>
                            <td>
                                <a href="../../controller/sitter_parent_cotroller.php?delete_child_id=<?=$row['id']?>"><i class="fa fa-trash"></i></a>
                            </td>
                            
                        </tr>
                    <?php }
                    } else { ?>
                        <div class="container">
                        <div class="row justify-content-md-center">
                        <div class="col-md-auto font-weight-bold">
                            No Children Registered
                        </div>
                        </div>
                    </div>
                    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </section>
              
           </div>
       </div>
<?php include("../included/profile_footer.php"); ?>