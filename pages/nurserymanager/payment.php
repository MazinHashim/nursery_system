<?php
session_start();
require_once "../../controller/db_operations.php";
$user = Controller::user_authorization("Nursery Manager");
$payment = true;
include("../included/header.php");
$query = "SELECT id, price FROM nursery WHERE manager_id={$user['id']}";
$nur = Controller::db_get_Foreign_id($query);
$children = Controller::db_get_accepted_children(false, $nur['id'], null);
?>

    <div class="tab-content" id="v-pills-settings-tab">
      <div class="row">
        <div class="col-md-12">
            <div class="card no-b">
                <div class="card-header white b-0 p-3">
                    <h4 class="card-title">Invoices</h4>
                    <!-- <small class="card-subtitle mb-2 text-muted">Items purchase by users.</small> -->
                </div>
                <div class="collapse show" id="invoiceCard">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="recent-orders"
                                  class="table table-hover mb-0 ps-container ps-theme-default">
                                <thead class="bg-light">
                                <tr>
                                    <th><h6>Child name</h6></th>
                                    <th><h6>Parent Phone</h6></th>
                                    <th><h6>Pay</h6></th>
                                    <th><h6>The rest</h6></th>
                                    <th><h6>Status</h6></th>
                                    <th><h6>Action</h6></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                  if($children->num_rows != 0){
                                    while($row = mysqli_fetch_assoc($children)) {
                                      $query = "SELECT username, aes_decrypt(phone, 'passkey') as phone FROM users WHERE rule='Parent' && id={$row['parent_id']}";
                                      $parent = Controller::db_get_Foreign_id($query);
                                  ?>
                                <tr>
                                    <td><?="{$row['name']} {$parent['username']}"?></td>
                                    <td><?=$parent['phone']?></td>
                                    <td><?=$row['fees']?></td>
                                    <td><?=($nur['price'] - $row['fees'] >= 0?$nur['price'] - $row['fees']: 0)?></td>
                                    <td><span class="badge <?=($nur['price'] - $row['fees'] >0 ? "badge-warning":"badge-success")?>"><?=($nur['price'] - $row['fees'] >0 ? "Overdue":"Paid")?></span></td>
                                    <td>
                                    <?php
                                    if($nur['price'] - $row['fees'] >0){?>
                                      <form action="../../controller/nursery_manager_controller.php" method="POST">
                                      <div class="input-group">
                                        <input placeholder="Fees" required type="number" name="fees"class="form-control-sm">
                                        <input hidden required name="old_fees" value="<?=$row['fees']?>">
                                        <input hidden required name="child_id" value="<?=$row['id']?>">
                                        <input hidden required name="price" value="<?=$nur['price']?>">
                                        <div class="input-group-append">
                                          <input type="submit" name="payment_submit" class='btn btn-info btn-sm' value="Pay">
                                        </div>
                                      </div>
                                      </form>
                                      
                                      <?php
                                    } else {
                                      echo "<strong class='text-success'>Satisfy ^_^</strong>";
                                    }
                                    ?>
                                    </td>
                                </tr>
                                <?php
                                  }
                                } else {
                                  ?>
                                  <tr>
                                    <div class="container">
                                      <div class="row justify-content-md-center">
                                        <div class="col-md-auto font-weight-bold">
                                          No Children Registered To Be Showed
                                        </div>
                                      </div>
                                    </div>
                                  </tr>
                                  <?php
                                }
                              ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>

  <!-- <button type="button" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary" data-toggle="modal" data-target="#exampleModal" >+</button>
  

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">new payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-12">
                    <label for="validationCustom01">pay</label>
                    <input class="form-control" id="validationCustom01" placeholder="id" value="1200" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-12">
                    <label for="validationCustom02">the rest</label>
                    <input class="form-control" id="validationCustom02" placeholder="name" value="800" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-12">
                    <label for="validationCustom01">child name</label>
                    <input class="form-control" id="validationCustom01" placeholder="id" value="ahmed omer" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6 mb-12">
                    <label for="validationCustom02">image of invoice</label>
                 <input type="file"></input>

                </div>
            </div><br>
            <div style="text-align: center;">
              <button class="btn btn-info" type="submit">save payment</button>
            </div>
        </form>
      </div>
    </div>
  </div> -->
  <?php include("../included/footer.php"); ?>
