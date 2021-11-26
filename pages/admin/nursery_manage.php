<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Admin");
$nursery_manage = true;
include("../included/header.php");
$nur_set = Controller::db_get_all_nurseries(null);
?>
<div>
  <br>
  <section>
    <a href="nursery_form_modal.php" class="btn btn-info btn-sm">Add new</a>

    <div class="card my-3 no-b">
      <div class="card-body" style="background-color: #f8f9fa!important;">
          <div class="card-title">All Nurseries</div>
          <table id="example2" class="table table-bordered table-hover data-tables">
              <thead>
              <tr>
                  <th>#ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Number of children</th>
                  <th>Need for babysitter ?</th>
                  <th>Time of work</th>
                  <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php
              if($nur_set->num_rows != 0){
              while ($row = mysqli_fetch_assoc($nur_set)) { ?>
                <tr>
                  <td><?=$row['id']?></td>
                  <td><img alt="Nursery Image" class="img-fluid img-thumbnail rounded" src="../../upload/nursery/<?=$row['image']?>" style="height: 50px; width= 50px;"></td>
                  <td><?=$row['name']?></td>
                  <td><?=$row['address']?></td>
                  <td> <?=$row['num_of_children']?></td>
                  <td><?=($row['need_babysitter']?'Yes':'No')?></td>
                  <td><?=$row['time_of_work']?></td>
                  <td>
                    <a href="nursery_form_modal.php?edit_nur_id=<?=$row['id']?>"><i class="fa fa-edit"></i></a>
                    <a href="../../controller/admin_nursery_controller.php?delete_nur_id=<?=$row['id']?>"><i class="fa fa-trash"></i></a>
                </td>
                  
              </tr>
              <?php }
              } else {
                echo "<tr>";
                  echo "<td colspan='8'>No Nursery Added</td>";
                echo "</tr>";
              }
              ?>
              </tbody>
          </table>
      </div>
  </div>
  </section>
</div>
<?php include("../included/footer.php"); ?>