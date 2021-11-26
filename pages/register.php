<?php session_start();
include("included/sign_header.php"); ?>
<?php if(isset($_SESSION["errorMessage"])){ ?>
<div class="alert alert-danger" role="alert">
<?php echo "<b>{$_SESSION["errorMessage"]}</b>";
$_SESSION["errorMessage"] = null;
?>
</div>
<?php } ?>
<form action="../controller/admin_controller.php" method="POST">
<div class="form-group">
    <input required type="text" name="username" class="form-control form-control-lg"
        placeholder="User Name">
</div>
<div class="form-group">
    <input required type="password" name="password" class="form-control form-control-lg"
        placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more character">
</div>
<div class="form-group">
<input required type="email" name="email" class="form-control form-control-lg"
        placeholder="example@gmail/yahoo.com" pattern="[a-zA-Z0-9._%+-]+@(gmail|yahoo)+\.com" title="Email Should Be Like example@gmail.com">
</div>
<div class="form-group">
<input required type="text" name="phone" class="form-control form-control-lg"
        placeholder="05********" pattern="[0][5][0-9]{8}" title='Enter valid phone number contain only 10 digits begin with 05'>
</div>
<fieldset class="form-group">
<div class="row">
    <legend class="col-form-label col-sm-2 pt-0">Role</legend>
    <div class="col-sm-10">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="rule" id="r_parent" value="Parent">
        <label class="form-check-label" for="r_parent">
        User
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="rule" id="r_sitter" value="Baby Sitter">
        <label class="form-check-label" for="r_sitter">
        Baby Sitter
        </label>
    </div>
    <div class="form-check disabled">
        <input class="form-check-input" type="radio" name="rule" id="r_nur" value="Nursery Manager">
        <label class="form-check-label" for="r_nur">
        Nursery Manager
        </label>
    </div>
    </div>
</div>
</fieldset>
<input type="submit" name="register_submit" class="btn btn-success btn-lg btn-block" value="Save Data">
<!-- <input class="btn btn-primary btn-sm btn-block" value="request acount" > --
</form>
<?php include("included/sign_footer.php"); ?>