<?php
session_start();
require_once "db_operations.php";

// Send Report To The Parents
if(isset($_POST["save_repo_submit"])){
    $parent_id = $_POST['repo_parent_id'];
    $nur_id = $_POST['repo_nur_id'];
    $repo_desc = $_POST['repo_desc'];
    $query = "INSERT INTO reports (description, parent_id, nursery_id, read_it) VALUES('$repo_desc',$parent_id, $nur_id, 0)";
    $done = Controller::performQuery($query);
    if($done){
        $_SESSION["infoMessage"] = "Report Send Successfully";
    } else {
        $_SESSION["errorMessage"] = "An Error Occur While Sending Report";   
    }
    header("Location: ../pages/nurserymanager/children.php");
}
// Nursery Manager Edit His Profile
if(isset($_POST["edit_manager_submit"])){
    $mng_id = $_POST['mng_id'];
    $mng_name = $_POST['mng_name'];
    $mng_address = $_POST['mng_address'];
    $mng_email = $_POST['mng_email'];
    $mng_pass = $_POST['mng_pass'];
    $mng_phone = $_POST['mng_phone'];
    if($_FILES['img']['name']!=null){
        $mng_img = $_FILES['img'];
        $upload_dest = Controller::upload_the_file($mng_img, array('png', 'jpg', 'jpeg','PNG', 'JPG', 'JPEG'), "../upload/user");
    } else {
        $upload_dest = $_POST['img'];
    }
    if (($upload_dest||empty($upload_dest))) {
        $query = "UPDATE users SET img=".(!empty($upload_dest)?"'$upload_dest'":"null").", username='$mng_name', address='$mng_address', email=aes_encrypt('$mng_email', 'passkey'), pass=aes_encrypt('$mng_pass', 'passkey'), phone=aes_encrypt('$mng_phone', 'passkey') WHERE id=$mng_id && rule='Nursery Manager'";
        $done = Controller::performQuery($query);
        if($done){
            $_SESSION["user_obj"]['username'] = $mng_name;
            $_SESSION["user_obj"]['address'] = $mng_address;
            $_SESSION["user_obj"]['email'] = $mng_email;
            $_SESSION["user_obj"]['pass'] = $mng_pass;
            $_SESSION["user_obj"]['phone'] = $mng_phone;
            if(!empty($upload_dest)){$_SESSION["user_obj"]['img'] = $upload_dest;}
            $_SESSION["infoMessage"] = "Nursery Manager Updated Successfully";
        } else {
            $_SESSION["errorMessage"] = "An Error Occur While Updating Nursery Manager";   
        }
    } else {
        $_SESSION["errorMessage"] = "<i class='fa fa-close'></i>Nursery doesn't Updated successfully because image extension is wrong";
    }
    header("Location:../pages/nurserymanager/edit_nursery_manager.php");
}

// Payment Fees Of Children
if(isset($_POST['payment_submit'])){
    $child_id = $_POST['child_id'];
    $fees = $_POST['fees'];
    $sum = $_POST['old_fees'] + $fees;
    $price = $_POST['price'];
    if($sum <= $price){
        $query1 = "UPDATE children set fees=$sum WHERE id=$child_id";
        $done1 = Controller::performQuery("$query1");
        if($done1){
            $_SESSION["infoMessage"] = "This Child Pay $sum \$". ($sum==$price? " and Now Your Fees are Completed":"Until Now");
        } else {
        $_SESSION["errorMessage"] = "An Error Occur While Payment";
            
        }
    } else {
        $_SESSION["errorMessage"] = "The Total Amount Fees Is Greater Than Nursery Price";
    }
    header("Location: ../pages/nurserymanager/payment.php");
}
// Nursery Manager Accept Baby Sitter & Parent Registration Request
if(isset($_GET["ntf_nur_name"]) && isset($_GET["ntf_user_id"]) && isset($_GET["ntf_nur_id"]) && isset($_GET["ntf_id"])){
    if(isset($_GET['ntf_child_id'])){
        $query1 = "UPDATE children SET accepted=true WHERE id={$_GET["ntf_child_id"]}";
        $query4 = "UPDATE nursery SET num_of_children=num_of_children+1 WHERE id={$_GET['ntf_nur_id']}";
        $done4 = Controller::performQuery($query4);
    } else {
        $query1 = "UPDATE users SET accepted=true WHERE id={$_GET["ntf_user_id"]} && nur_id={$_GET["ntf_nur_id"]}";
    }
    $query2 = "DELETE FROM notification WHERE notf_id={$_GET["ntf_id"]}";
    $query3 = "INSERT INTO notification (description, nur_id, user_id, notf_of) VALUES('You Are Accepted at {$_GET['ntf_nur_name']}, Will Call You Letter',{$_GET['ntf_nur_id']}, {$_GET['ntf_user_id']}, '". (isset($_GET['ntf_child_id'])?"Parent":"Baby Sitter") ."')";
    
    $done1 = Controller::performQuery($query1);
    $done2 = Controller::performQuery($query2);
    $done3 = Controller::performQuery($query3);
    if(!($done1 && $done2 && $done3)){
        $_SESSION["errorMessage"] = "Not Accepted";
    }
    header("Location: ../pages/nurserymanager/nursery_info.php");
}
// Nursery Manager Delete Baby Sitter
if(isset($_GET['del_sitter_id']) && isset($_GET['mng_name']) && isset($_GET['mng_nur_id'])){
    $query1 = "UPDATE users SET nur_id=NULL, accepted=NULL WHERE id={$_GET['del_sitter_id']} and rule='Baby Sitter'";
    $query2 = "INSERT INTO notification (description, nur_id, user_id, notf_of) VALUES('Mg.{$_GET['mng_name']} Delete You From His Nursery',{$_GET['mng_nur_id']}, {$_GET['del_sitter_id']}, 'Baby Sitter')";
    $done1 = Controller::performQuery($query1);
    $done2 = Controller::performQuery($query2);
    if($done1 && $done2) {
        $_SESSION["infoMessage"] = "Baby Sitter Deleted Successfully";
    } else {
        $_SESSION["errorMessage"] = "An Error Occur While Deleting Baby Sitter";
    }
    header("Location: ../pages/nurserymanager/babysitters.php");
}
// Nursery Manager Delete Children
if(isset($_GET['del_child_id']) && isset($_GET['child_name']) && isset($_GET['parent_id']) && isset($_GET['mng_name']) && isset($_GET['mng_nur_id'])){
    $query1 = "DELETE FROM children WHERE id={$_GET['del_child_id']}";
    $query2 = "INSERT INTO notification (description, nur_id, user_id, notf_of) VALUES('Mg.{$_GET['mng_name']} Delete Your Child {$_GET['child_name']} From His Nursery',{$_GET['mng_nur_id']}, {$_GET['parent_id']}, 'Parent')";
    $query3 = "UPDATE nursery set num_of_children=num_of_children-1 WHERE id={$_GET['mng_nur_id']}";
    $done1 = Controller::performQuery($query1);
    $done2 = Controller::performQuery($query2);
    $done3 = Controller::performQuery($query3);
    if($done1 && $done2 && $done3) {
        $_SESSION["infoMessage"] = "Child Deleted Successfully";
    } else {
        $_SESSION["errorMessage"] = "An Error Occur While Deleting Child";
    }
    header("Location: ../pages/nurserymanager/children.php");
}
?>