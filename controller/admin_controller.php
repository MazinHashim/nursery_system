<?php
session_start();
require_once "../models/User.php";
require_once "../models/Nursery.php";
require_once "db_operations.php";

// When User Logged Out
if(isset($_GET["outMe"])){
    $_SESSION["user_obj"] = null;
    header("Location:../pages/index.php");
}
// When User Logged In
if(isset($_POST['login_submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = AdminController::user_login($email, $password);
    // print_r($user);
    if($user){
        if($user["isVerified"]){
            if($user["rule"] == "Nursery Manager" && !isset($user["nur_id"])){
                $_SESSION["infoMessage"] = "No Nursery Associated To You...";
                header("Location:../pages/login.php");
            } else {
                $pageRoute = Controller::routeToAuthorizedPage($user["rule"]);
                $_SESSION["user_obj"] = $user;
                header("Location:../pages/$pageRoute");
            }
        } else {
            $_SESSION["infoMessage"] = "You Are Not Accepted Yet...";
            header("Location:../pages/login.php");
        }
    } else {
        $_SESSION["errorMessage"] = "Email or Password is wrong";
        header("Location:../pages/login.php");
    }
}
// When User Request New Account
if(isset($_POST['register_submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $rule = $_POST['rule'];
    $phone = $_POST['phone'];
    $model = new User("$username", "$phone", "$email", "$password", "$rule", false);
    $registered = AdminController::register_user($model);
    if($registered){
        $_SESSION["infoMessage"] = "Wait For Admin To Verify Your Data, Then You Can Logged In";
        header("Location:../pages/login.php");
    } else {
        $_SESSION["errorMessage"] = "Email or Phone Number is already exist";
        header("Location:../pages/register.php");
    }
}
// When User Change His Profile Image
if(isset($_POST["upload_user_submit"])){
    $user_id = $_POST['user_id'];
    $rule = $_POST['rule'];
    if($_FILES["upload_user_img"]['name']!=null){
        $img_file = $_FILES["upload_user_img"];
        $upload_dest = Controller::upload_the_file($img_file, array('png', 'jpg', 'jpeg','PNG', 'JPG', 'JPEG'), "../upload/user");
    } else {
        $upload_dest = $_POST["upload_user_img"];
    }
    if(($upload_dest||empty($upload_dest))){
        $query = "UPDATE users set img=".(!empty($upload_dest)?"'$upload_dest'":"null")." WHERE id=$user_id && rule='$rule'";
        $done = Controller::performQuery($query);
        if($done){
            if(!empty($upload_dest)){$_SESSION["user_obj"]['img'] = $upload_dest;}
        }
        else
            $_SESSION["errorMessage"] = "An Error Occur While Changing Profile Image";
    } else {
        $_SESSION["errorMessage"] = "<i class='fa fa-error'></i>Profile Image doesn't changed successfully because image extension is wrong";
    }
    header("Location:../pages/" . Controller::routeToAuthorizedPage($rule));

}

// When User Request Need To Be Accepted By The Admin
if(isset($_GET["acceptId"])){

    $id = $_GET["acceptId"];
    $user = AdminController::accept_user($id);
    if($user){
        header("Location:../pages/admin/register_user.php");
    }
}
// When User Request Need To Be Rejected By The Admin
if(isset($_GET["rejectId"])){

    $id = $_GET["rejectId"];
    $user = AdminController::delete_user($id);
    if($user){
        header("Location:../pages/admin/register_user.php");
    }
}
if(isset($_GET["del_sitter_id"]) || isset($_GET["del_mng_id"])){

    $id = isset($_GET["del_sitter_id"]) ? $_GET["del_sitter_id"] : $_GET["del_mng_id"];
    $done = AdminController::unauthorize_user($id);

    if($done){
        if(isset($_GET["del_sitter_id"]))
            header("Location:../pages/admin/baby_sitters_manage.php");
        else
            header("Location:../pages/admin/nursery_manager_manage.php");
    }
}

class AdminController {

    public static function register_user($user){
        $query = "INSERT INTO users(username, email, pass, phone, rule, isVerified) VALUES ('{$user->username}', aes_encrypt('{$user->email}','passkey'), aes_encrypt('{$user->password}','passkey'), aes_encrypt('{$user->phone}','passkey'), '{$user->rule}', false)";
        $user_set = Controller::performQuery($query);
        if($user_set){
            return true;
        }
        return false;
    }
    public static function user_login($email, $password){
        $user_set = Controller::db_get_verified_data($email, $password);
        return $user_set;
    }
    public static function accept_user($id){

        $user_set = Controller::db_update_verified($id);
        if($user_set){
            $user = new User("{$user_set['username']}", "{$user_set['phone']}", "{$user_set['email']}", "{$user_set['pass']}", "{$user_set['rule']}", $user_set['isVerified']);
            return $user;
        }
    }
    public static function delete_user($id){
        $table = "users";
        $user_set = Controller::db_delete($table, $id);
        if($user_set){
            $user = new User("{$user_set['username']}", "{$user_set['phone']}", "{$user_set['email']}", "{$user_set['pass']}", "{$user_set['rule']}", $user_set['isVerified']);
            return $user;
        }
    }
    public static function unauthorize_user($id){
        $query = "UPDATE users SET isVerified=false WHERE id=$id";
        return Controller::performQuery($query);
    }
}
?>