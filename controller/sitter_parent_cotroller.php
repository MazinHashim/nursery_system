<?php
session_start();
require_once "../models/User.php";
require_once "../models/children.php";
require_once "db_operations.php";

// Delete Child
if (isset($_GET['delete_child_id'])) {
    $query1 = "DELETE FROM notification WHERE child_id={$_GET['delete_child_id']}";
    $done1 = Controller::performQuery($query1);
    $query2 = "SELECT nur_id FROM children WHERE id={$_GET['delete_child_id']}";
    $nur_set = Controller::db_get_Foreign_id($query2);
    $query3 = "DELETE FROM children WHERE id={$_GET['delete_child_id']}";
    $done3 = Controller::performQuery($query3);
    print_r($nur_set);
    $query4 = "UPDATE nursery set num_of_children=num_of_children-1 WHERE id={$nur_set['nur_id']}";
    $done4 = Controller::performQuery($query4);
    if($done1 && $done3 && $done4){
        $_SESSION["infoMessage"] = "Your Child Deleted Successfully";
    } else {
        $_SESSION["errorMessage"] = "An Error Occur While Deleting Child";
    }
    header("Location: ../pages/user/children_tab.php");
}

// Parent Send Child Registration Request To The Nursery Or Update Children
if(isset($_POST['add_child_btn']) || isset($_POST['edit_child_btn'])){
    $name = $_POST['c_name'];
    $age = $_POST['age'];
    $nur_id = $_POST['nur_id'];
    $uid = $_POST['uid'];
    $message = "";
    $errorMsg = "";

    if(isset($_POST['edit_child_btn'])){
        $cid = $_POST['cid'];
        $query = "UPDATE children SET name='$name', age=$age WHERE id=$cid";
        $done = Controller::performQuery($query);
        $message = "Your Child Updated Successfully";
        $errorMsg = "An Error Occur While Updating Child";
    } else {
        $child = new Child($name, $age, 0, 0, $nur_id, $uid);
        $done = SitterParentController::send_child_request($child);
        $message = "Your Child Registration Request Sent Successfully";
        $errorMsg = "An Error Occur While Sending Child Registration Request";
    }
    if($done){
        $_SESSION["infoMessage"] = $message;
    } else {
        $_SESSION["errorMessage"] = $errorMsg;
    }
    header("Location: ../pages/user/show_nursery.php");
    
}

// Baby Sitter Send Jop Request To The  Nursery
if(isset($_GET["uname"]) && isset($_GET["uid"]) && isset($_GET["nur_id"])){
    $query1 = "UPDATE users set nur_id={$_GET['nur_id']}, accepted=false WHERE id={$_GET['uid']} and rule='Baby Sitter'";
    $query2 = "INSERT INTO notification (description, nur_id, user_id) VALUES('{$_GET['uname']} Send Jop Request For This Nursery',{$_GET['nur_id']}, {$_GET['uid']})";
    $done1 = Controller::performQuery("$query1");
    $done2 = Controller::performQuery("$query2");
    if($done1 && $done2){
        $_SESSION["user_obj"]["accepted"] = false;
        $_SESSION["user_obj"]["nur_id"] = $_GET['nur_id'];
        $_SESSION["infoMessage"] = "Your Request Sent Successfully";
    } else {
        $_SESSION["errorMessage"] = "This Baby Sitter Was Already Sending Request";
    }
    header("Location: ../pages/babysitter/show_nursery.php");
}
if(isset($_GET["cancel_uname"]) && isset($_GET["cancel_uid"]) && isset($_GET["cancel_nur_id"])){
    $query1 = "UPDATE users set nur_id=null, accepted=null WHERE id={$_GET['cancel_uid']} and rule='Baby Sitter'";
    $query2 = "DELETE FROM notification WHERE nur_id={$_GET["cancel_nur_id"]} && user_id={$_GET["cancel_uid"]} && notf_of is null";
    $done1 = Controller::performQuery("$query1");
    $done2 = Controller::performQuery("$query2");
    if($done1 && $done2){
        $_SESSION["user_obj"]["accepted"] = null;
        $_SESSION["user_obj"]["nur_id"] = $_GET['nur_id'];
        $_SESSION["infoMessage"] = "Your Request Sent Successfully";
    } else {
        $_SESSION["errorMessage"] = "This Baby Sitter Was Already Sending Request";
    }
    header("Location: ../pages/babysitter/show_nursery.php");
}

// Baby Sitter Or Parent Edit His Profile
if(isset($_POST["save_user"])){
    $username =  $_POST['username'];
    $address =  $_POST['address'];
    $phone =  $_POST['phone'];
    $work_h =  $_POST['work_h']??null;
    $price =  $_POST['price']??null;
    $user_id =  $_POST['user_id'];
    $rule =  $_POST['rule'];
    // echo $_FILES["img"]["name"] == null;
    if($_FILES["img"]["name"]!=null){
        $img_file = $_FILES['img'];
        $upload_dest = Controller::upload_the_file($img_file, array('png', 'jpg', 'jpeg','PNG', 'JPG', 'JPEG'), ($work_h?"../upload/babysitter":"../upload/user"));
    } else {
        $upload_dest = $_POST["img"];
        echo $upload_dest ."Mazin";
    }
    $certif_dest = null;
    if($rule == "Baby Sitter"){
        if ($_FILES['certificate']["name"]!=null) {
            $pdf_file = $_FILES['certificate']??null;
            $certif_dest = !$pdf_file?null:Controller::upload_the_file($pdf_file, array('pdf', 'PDF'), "../pages/babysitter/upload");# code...
        } else {
            $certif_dest = $_POST['certificate'];
            echo $upload_dest . $certif_dest."Mazin";
        }
    }

    if(($upload_dest||empty($upload_dest)) && ($rule=="Parent"?true:($certif_dest||empty($certif_dest)))){
        echo !empty($upload_dest)?$upload_dest:"null";
        $updated = SitterParentController::edit_user($user_id, $rule, $username, $address, $phone, $work_h, $price, !empty($upload_dest)?$upload_dest:null, !empty($certif_dest)?$certif_dest:null);
        if($updated){
           if($rule == "Baby Sitter"){
            if(!empty($certif_dest)){$_SESSION["user_obj"]["certif"] = $certif_dest;}
            $_SESSION["user_obj"]["price"] = $price;
            $_SESSION["user_obj"]["work_hours"] = $work_h;
           }
            $_SESSION["user_obj"]["address"] = $address;
            $_SESSION["user_obj"]["username"] = $username;
            $_SESSION["user_obj"]["phone"] = $phone;
            if(!empty($upload_dest)){$_SESSION["user_obj"]['img'] = $upload_dest;}

            $_SESSION["infoMessage"] = "This User Updated Successfully";
        }
        else
            $_SESSION["errorMessage"] = "An Error Occur When You update User";
    } else {
        $_SESSION["errorMessage"] = "<i class='fa fa-close'></i>User doesn't updated successfully because selected file extension is wrong";
    }
    if ($rule=="Parent") {
        header("Location: ../pages/user/edit_profile.php");
    } else {
        header("Location: ../pages/babysitter/edit_profile.php");
    }
}
// Parent Evaluate The Nursery Services
if(isset($_GET['rating_value'])){

    $rating_value = $_GET['rating_value'];
    $nur_id = $_GET['nur_id'];
    $parent_id = $_GET['parent_id'];

    $query_str2 = "SELECT rating FROM user_rating WHERE nur_id=$nur_id && parent_id=$parent_id LIMIT 1";
    $isExist = Controller::db_get_Foreign_id($query_str2);
    
    if($isExist){
        $query_del = "DELETE FROM user_rating WHERE nur_id=$nur_id && parent_id=$parent_id";
        $deleted = Controller::performQuery($query_del);
    }
    $query = "INSERT INTO user_rating (rating, nur_id, parent_id) VALUES($rating_value, $nur_id, $parent_id)";
    $done = Controller::performQuery($query);
    if($done){
        $_SESSION["infoMessage"] = "Thank You For Your Feedback";
    } else {
        $_SESSION["errorMessage"] = "An Error Occurs While Rating The Nursery";
    }
    header("Location: ../pages/user/show_nursery.php");
}
// When Baby Sitter Accept Parent Request
if(isset($_GET["parent_id"]) && isset($_GET["ntf_id"]) && isset($_GET["sitter_name"])){
    
    $query1 = "UPDATE users SET accepted=true WHERE id={$_GET["parent_id"]}";
    $query2 = "DELETE FROM notification WHERE notf_id={$_GET["ntf_id"]}";
    $query3 = "INSERT INTO notification (description, user_id, notf_of) VALUES('{$_GET['sitter_name']} Accept Your Request, Will Call You Letter', {$_GET['parent_id']}, 'Parent')";
    
    $done1 = Controller::performQuery($query1);
    $done2 = Controller::performQuery($query2);
    $done3 = Controller::performQuery($query3);
    if(!($done1 && $done2 && $done3)){
        $_SESSION["errorMessage"] = "Not Accepted";
    }
    header("Location: ../pages/babysitter/profile_view.php");
}
// Make Report Read When Tab it
if(isset($_GET["parent_repo_read_id"])){
    $id = $_GET["parent_repo_read_id"];
    $query = "UPDATE reports SET read_it=true WHERE parent_id=$id";
    $done = Controller::performQuery($query);
    header("Location: ../pages/user/reports_tab.php");
}

// When Parent Send Jop Request To Baby Sitter
if(isset($_GET["parent_req_sitter_id"]) && isset($_GET["req_parent_id"]) && isset($_GET["req_parent_name"])){
    $query1 = "UPDATE users set sitter_id={$_GET['parent_req_sitter_id']}, accepted=false WHERE id={$_GET['req_parent_id']} and rule='Parent'";
    $query2 = "INSERT INTO notification (description, user_id, notf_of) VALUES('{$_GET['req_parent_name']} Need You For His Children',{$_GET['parent_req_sitter_id']}, 'Baby Sitter')";
    $done1 = Controller::performQuery("$query1");
    $done2 = Controller::performQuery("$query2");
    if($done1 && $done2){
        $_SESSION["user_obj"]["accepted"] = false;
        $_SESSION["user_obj"]["sitter_id"] = $_GET['parent_req_sitter_id'];
        $_SESSION["infoMessage"] = "Your Request Sent Successfully";
    } else {
        $_SESSION["errorMessage"] = "You Are Already Sending Request For This Baby Sitter";
    }
    header("Location: ../pages/user/baby_sitter_tab.php");
}
// When Parent Cancel Jop Request To Baby Sitter
if(isset($_GET["parent_req_sitter_del_id"]) && isset($_GET["req_parent_del_id"]) && isset($_GET["req_parent_del_name"])){
    $query1 = "UPDATE users set sitter_id=null, accepted=null WHERE id={$_GET['req_parent_del_id']} and rule='Parent'";
    $query2 = "DELETE FROM notification WHERE user_id={$_GET['parent_req_sitter_del_id']} && notf_of='Baby Sitter'";
    $done1 = Controller::performQuery("$query1");
    $done2 = Controller::performQuery("$query2");
    if($done1 && $done2){
        $_SESSION["user_obj"]["accepted"] = null;
        $_SESSION["user_obj"]["sitter_id"] = null;
        $_SESSION["infoMessage"] = "Your Request Has Been Canceled";
    } else {
        $_SESSION["errorMessage"] = "You Are Already Sending Request For This Baby Sitter";
    }
    header("Location: ../pages/user/baby_sitter_tab.php");
}
// User Clear His Notifications
if (isset($_GET['clear_ntf_uid']) && isset($_GET['clear_ntf_rule'])) {
    $uid = $_GET['clear_ntf_uid'];
    $rule = $_GET['clear_ntf_rule'];

    $query = "DELETE FROM notification WHERE user_id=$uid";
    $cleared = SitterParentController::clear_notification($query);
    if(!$cleared){
        $_SESSION["errorMessage"] = "An Error Occur While Clearing notifications";
    }
    header("Location:../pages/".($rule == "Parent"?"user":"babysitter")."/profile_view.php");
}

class SitterParentController{

    public static function clear_notification($query){
        
        $set = Controller::performQuery($query);
        if($set){
            return true;
        }
        return false;
    }

    public static function edit_user($id, $rule, $name, $add, $ph, $wk, $price, $img, $certif){

        if($rule == "Baby Sitter"){
            $query = "UPDATE users set username='$name', address='$add', phone=aes_encrypt('$ph', 'passkey'), img=".($img?"'$img'":"null").", work_hours='$wk', price=$price, certif=".($certif?"'$certif'":"null")." WHERE id=$id";
        } else {
            $query = "UPDATE users set username='$name', address='$add', phone=aes_encrypt('$ph', 'passkey'), img='$img' WHERE id=$id";
        }
        $done = Controller::performQuery($query);
        if($done){
            return true;
        }
        return false;
    }
    public static function send_child_request($child){
        $query1 = "INSERT INTO children (name, age, fees, accepted, nur_id, parent_id) VALUES ('{$child->name}', {$child->age}, {$child->fee}, {$child->accepted}, {$child->nur_id}, {$child->parent_id})";
        $done1 = Controller::performQuery($query1);
        $query2 = "SELECT id FROM children WHERE name='{$child->name}' && age={$child->age} && fees=0 && accepted=0 && nur_id={$child->nur_id} && parent_id={$child->parent_id} LIMIT 1";
        $sql_child = Controller::db_get_Foreign_id($query2);
        $query3 = "INSERT INTO notification (description, nur_id, user_id, child_id) VALUES('{$child->name} Send Child Registration Request For This Nursery',{$child->nur_id}, {$child->parent_id}, {$sql_child['id']})";
        $done3 = Controller::performQuery($query3);
        if($done1 && $done3){
            return true;
        }
        return false;
    }
}
?>