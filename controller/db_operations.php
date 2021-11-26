<?php
define("HOST", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "nurserysystem");

class Controller
{
    public static function upload_the_file($the_file, $allowedExt,$root){
        $file_name =  $the_file['name'];
        $file_tmp_name =  $the_file['tmp_name'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        if(in_array($file_ext, $allowedExt)){
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            $destination = "$root/$new_file_name";
            if(move_uploaded_file($file_tmp_name, $destination)){
                return $new_file_name;
            } else {
                return null;
            }
        }
    }

    public static function user_authorization($user_rule){
        if(isset($_SESSION["user_obj"]) && $_SESSION["user_obj"]["rule"] == "$user_rule"){
            // print_r($_SESSION["user_obj"]);
            return $_SESSION["user_obj"];
          } else {
            header("Location:../login.php");
          }
    }
    public static function routeToAuthorizedPage($rule){
        switch($rule){
            case "Admin": $pageRoute = "admin/register_user.php"; break;
            case "Nursery Manager": $pageRoute = "nurserymanager/nursery_info.php"; break;
            case "Parent": $pageRoute = "user/profile_view.php"; break;
            case "Baby Sitter": $pageRoute = "babysitter/profile_view.php"; break;
        }
        return $pageRoute;
    }
    public static function db_connection(){
        $connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if(mysqli_connect_errno()){
        die("Database Connection Failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
        }
        return $connection;
    }
    public static function db_close($connection){
        if (isset($connection)){
            mysqli_close($connection);
        }
    }
    
    public static function db_get_verified_data($email, $password){
        $query = "SELECT id, username, aes_decrypt(email, 'passkey') as email, aes_decrypt(pass, 'passkey') as pass, aes_decrypt(phone, 'passkey') as phone, isVerified, rule, address, work_hours, price, certif, img, accepted, nur_id, sitter_id
         FROM users WHERE email=aes_encrypt('$email', 'passkey') && pass=aes_encrypt('$password','passkey') && isVerified=true";
        $result = Controller::performQuery($query);
        if( $user_set = mysqli_fetch_assoc($result) ){
            return $user_set;
        }
    }
    public static function db_get_all_nurseries($filter){
        $query = "SELECT * FROM nursery ".($filter??"");
        $result = Controller::performQuery($query);
        return $result;
    }
    public static function db_get_Foreign_id($query){
        $result = Controller::performQuery($query);
        if( $set = mysqli_fetch_assoc($result) ){
            return $set;
        }
    }
    public static function db_get_unVerified_data(){
        $query = "SELECT * FROM users WHERE isVerified=false";
        return Controller::performQuery($query);
    }
    public static function db_get_notification_data($ofUser, $id, $rule){
        $query = "SELECT * FROM notification WHERE ".($ofUser?"notf_of='$rule' && user_id=$id":"notf_of is null && nur_id=$id");
        return Controller::performQuery($query);
        // return $query;
    }
    public static function db_get_reports_data($id){
        $query1 = "SELECT * FROM reports WHERE parent_id=$id";
        return Controller::performQuery($query1);
    }

    public static function db_get_unread_reports_counts($id){
        $query = "SELECT COUNT(*) as badge FROM reports WHERE parent_id=$id && read_it=0";
        $result = Controller::performQuery($query);
        if($repo_count = mysqli_fetch_assoc($result)) {
            return $repo_count["badge"];
        }
    }

    public static function db_get_nurseries_managers($ignore, $search_param){
        $query = "SELECT ". ($ignore?"*":"id,username") . " FROM users WHERE ".($search_param ? "$search_param && " : "") ." isVerified=true && rule='Nursery Manager'" . ($ignore?"":" && nur_id is null");
        return Controller::performQuery($query);
    }
    public static function db_get_baby_sitters($ignore, $byAccepted, $search_param){
        $query = "SELECT * FROM users WHERE ".($search_param ? "$search_param && " : "") ."isVerified=true ".($byAccepted?"&& accepted=true ":"")."&& rule='Baby Sitter'" . ($ignore?"":" && nur_id is null");
        return Controller::performQuery($query);
    }
    public static function db_get_accepted_children($ofParent, $id, $search_param){
        $query = "SELECT * FROM children WHERE ".($search_param ? "$search_param && " : "") . ($ofParent?"parent_id=$id":"nur_id=$id") ." and accepted=true ORDER BY name";
        return Controller::performQuery($query);
    }

    public static function db_update_verified($id){
        $query = "UPDATE users SET isVerified=true WHERE id=$id";
        return Controller::performQuery($query);
    }
    public static function db_delete($table, $id){
        $query = "DELETE FROM $table WHERE id=$id";
        return Controller::performQuery($query);
    }

    public static function performQuery($query){
        $connection = Controller::db_connection();
        $result = mysqli_query($connection, $query);
        Controller::db_close($connection);
        return $result;
    }
}