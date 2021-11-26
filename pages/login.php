<?php session_start();
include("included/sign_header.php");

if(isset($_SESSION["errorMessage"])){
  echo "<div class='alert alert-danger' role='alert'>";
  echo "<b>{$_SESSION["errorMessage"]}</b>";
  $_SESSION["errorMessage"] = null;
  echo "</div>";
  }
  
  if(isset($_SESSION["infoMessage"])){ 
  echo "<div class='alert alert-info' role='alert'>";
  echo "<b>{$_SESSION["infoMessage"]}</b>";
  $_SESSION["infoMessage"] = null;
  echo "</div>";
?>

<?php } ?>

<form action="../controller/admin_controller.php" method="POST">
    <div class="form-group has-icon"><i class="icon-envelope-o"></i>
        <input required type="text" name="email" class="form-control form-control-lg"
                placeholder="example@gmail/yahoo.com" pattern="[a-zA-Z0-9._%+-]+@(gmail|yahoo)+\.com" title="Email Should Be Like example@gmail.com">
    </div>
    <div class="form-group has-icon"><i class="icon-user-secret"></i>
        <input  required type="password" name="password" class="form-control form-control-lg"
                placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more character">
    </div>
    <input type="submit" name="login_submit" class="btn btn-success btn-lg btn-block" value="Log In"/>
    <p class="forget-pass">Don't have account ??</p>
    <!-- <input class="btn btn-primary btn-sm btn-block" value="request acount" > -->
    <div class="container">
      <div class="row justify-content-between">
        <a href="register.php" class="btn btn-primary btn-sm" >Request Account</a>
        <a href="index.php" class="btn btn-primary btn-sm" >Back To Home</a>
      </div>
    </div>
    <!-- <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#exampleModal" >Request Account</button> -->
</form>
<?php include("included/sign_footer.php"); ?>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">your email:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send</button>
        </div>
      </div>
    </div>
  </div> -->