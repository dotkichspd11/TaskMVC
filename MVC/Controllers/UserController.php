<?php 
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if(isset($_GET['action'])){
    $action = $_GET['action'];
}else {
    $action = '';
}

switch($action){
    case 'user' :{
        require_once './MVC/Views/UserView.php';
        break;
    }
    case 'add' :{
        if(isset($_POST['add'])){
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['pass'];
            $dateofbirth =  $_POST['dateofbirth'];
            
            $db->addData($fullname, $email, $pass, $dateofbirth);
        }
        require_once './MVC/Views/UserView.php';
        break;       
    }
    case 'edit' :{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $tblTable = "user";
            $dataID = $db->getDataID($tblTable, $id);
        }
        if(isset($_POST['update'])){
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['pass'];
            $dateofbirth =  $_POST['dateofbirth'];
            
            $db->updateData($id, $fullname, $email, $phone, $dateofbirth);
        }
        require_once './MVC/Views/UserView.php';
        break;       
    }
    case 'delete' :{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $tblTable = "user";
            if($db->deleteData($id,$tblTable)){
                header("Location: ./MVC/Views/UserView.php");
            };
            
        }
        // require_once './MVC/Views/CustomerView.php';
        break;
    }
    default :{
        require_once './MVC/Views/UserView.php';
        break;
    }
}
?>