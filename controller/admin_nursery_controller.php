<?php
session_start();
require_once "../models/Nursery.php";
require_once "db_operations.php";

if(isset($_GET['delete_nur_id'])){
    $id = $_GET['delete_nur_id'];
    $query1 = "UPDATE users set nur_id=null WHERE nur_id=$id";
    $query2 = "DELETE FROM children WHERE nur_id=$id";
    $query3 = "DELETE FROM notification WHERE nur_id=$id";
    $query3 = "DELETE FROM user_rating WHERE nur_id=$id";
    $query3 = "DELETE FROM reports WHERE nursery_id=$id";
    $done1 = Controller::performQuery($query1);
    $done2 = Controller::performQuery($query2);
    $done3 = Controller::performQuery($query3);
    $done2 = AdminNurseryController::delete_nursery($id);
    if(!$done1 && !$done2){
        $_SESSION['errorMessage'] = "Nursery Number $id Doesn't Deleted";
    }
    header("Location:../pages/admin/nursery_manage.php");
}
if(isset($_GET["decrease_child_num"])) {
    $id = $_GET["decrease_child_num"];
    $query1 = "UPDATE nursery SET num_of_children=num_of_children-1 WHERE id=$id";
    $done1 = Controller::performQuery($query1);
    if($done1){
        $_SESSION["infoMessage"] = "Child Deleted Successfully";
        header("Location:../pages/nurserymanager/nursery_info.php");
    } else {
        $_SESSION["errorMessage"] = "Error: Child Does Not Deleted";
        header("Location:../pages/nurserymanager/nursery_info.php");
    }
}
// When Admin Add Or Edit Nursery To The System
if(isset($_POST["add_nursery"]) || isset($_POST["edit_nursery"])){
    $nur_name =  $_POST['nur_name'];
    $nur_address =  $_POST['nur_address']??null;
    $num_of_ch =  $_POST['num_of_ch']??null;
    $need_sitter =  $_POST['need_sitter']??null;
    $price =  $_POST['price']??null;
    $max_num =  $_POST['max_num']??null;
    $t_of_w =  $_POST['t_of_w']??null;
    $manager_id =  $_POST['manager_id'];
    $rule =  $_POST['rule']??null;
    
    if ($_FILES['img']??null && $_FILES['img']['name']!=null) {
        $img_file = $_FILES['img'];
        $upload_dest = Controller::upload_the_file($img_file, array('png', 'jpg', 'jpeg','PNG', 'JPG', 'JPEG'), "../upload/nursery");
    } else {
        $upload_dest = $_POST["img"]??null;
    }

    $isAddOp = isset($_POST["add_nursery"])?"Add":"Update";
    $nur_id = null;
    if($isAddOp === "Update"){
        $nur_id = $_POST['nur_id'];
    }
    if(($upload_dest||empty($upload_dest))){
        if ($price) {
            $priceQ = "UPDATE nursery SET price='$price' WHERE id=$nur_id";
            $priceD = Controller::performQuery($priceQ);
        }
        if ($max_num) {
            if($num_of_ch<=$max_num){
                $max_numQ = "UPDATE nursery SET maximum='$max_num' WHERE id=$nur_id";
                $max_numD = Controller::performQuery($max_numQ);
            } else {
                $_SESSION["errorMessage"] = "Sorry:: Maximum Should Be Greater Or Equal Than Number Of Registered Children";
            }
        }
        $model = new Nursery($nur_id, $nur_name, !empty($upload_dest)?$upload_dest:null, $nur_address, $num_of_ch, $need_sitter, $t_of_w, $manager_id);
        if($rule === "Admin" && $isAddOp === "Update"){
            $query = "UPDATE nursery SET name='$nur_name', manager_id=$manager_id WHERE id=$nur_id";
            $added = Controller::performQuery($query);
        } else {
            $added = AdminNurseryController::add_nursery($model, $isAddOp);
        }
        if($added)
            $_SESSION["infoMessage"] = "This Nursery {$isAddOp}ed Successfully";
        else
            $_SESSION["errorMessage"] = "An Error Occur When You {$isAddOp} Nursery";
    } else
        $_SESSION["errorMessage"] = "<i class='fa fa-close'></i>Nursery doesn't {$isAddOp}ed successfully because image extension is wrong";

    if ($price) {
        header("Location:../pages/nurserymanager/nursery_info.php");
    } else {
        header("Location:../pages/admin/nursery_manage.php");
    }
}
class AdminNurseryController{
    
    public static function add_nursery($nursery, $op){
        if($op === "Add")
            $query1 = "INSERT INTO nursery(name, manager_id) VALUES ('{$nursery->name}', {$nursery->manager_id})";
        else if($op === "Update"){
            $name = $nursery->name;
            $img = $nursery->img?$nursery->img:null;
            $address = $nursery->address;
            $need_bs = $nursery->need_babysitter;
            $n_of_c = $nursery->num_of_children;
            $t_of_w = $nursery->time_of_work;
            $query1 = "UPDATE nursery SET name='$name', image='$img', address='$address', need_babysitter=$need_bs, num_of_children=$n_of_c, time_of_work='$t_of_w', manager_id={$nursery->manager_id} WHERE id={$nursery->id}";
        }
        
            // $query1 = "UPDATE nursery SET name='{$nursery->name}', manager_id={$nursery->manager_id} WHERE id={$nursery->id}";
        $done1 = Controller::performQuery($query1);
        $query2 = "SELECT id FROM nursery WHERE manager_id={$nursery->manager_id} LIMIT 1";
        $user_set = Controller::db_get_Foreign_id($query2);
        $query3 = "UPDATE users set nur_id={$user_set['id']} WHERE id=$nursery->manager_id && isVerified=true";
        $done2 = Controller::performQuery($query3);
        if($done1 && $done2){
            return true;
        }
        return false;
    }

    public static function delete_nursery($id){
        $table = "nursery";
        $nursery_set = Controller::db_delete($table, $id);
        if($nursery_set){
            return true;
        }
        return false;
    }
}
?>