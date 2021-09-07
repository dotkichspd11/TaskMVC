<?php 
if(isset($_GET['action'])){
    $action = $_GET['action'];
}else {
    $action = '';
}

switch($action){
    case 'customer' :{
        require_once './MVC/Views/CustomerView.php';
        break;
    }
    case 'add' :{
        if(isset($_POST['add'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $dateofbirth =  $_POST['dateofbirth'];
            
            $db->addData($fullname, $email, $phone, $dateofbirth);
        }
        require_once './MVC/Views/CustomerView.php';
        break;       
    }
    case 'edit' :{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $tblTable = "customer";
            $dataID = $db->getDataID($tblTable, $id);
        }
        if(isset($_POST['update'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $dateofbirth =  $_POST['dateofbirth'];
            
            $db->updateData($id, $fullname, $email, $phone, $dateofbirth);
        }
        require_once './MVC/Views/CustomerView.php';
        break;       
    }
    case 'delete' :{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $tblTable = "customer";
            if($db->deleteData($id,$tblTable)){
                header("Location: ./MVC/Views/CustomerView.php");
            };
            
        }
        // require_once './MVC/Views/CustomerView.php';
        break;
    }
    default :{
        require_once './MVC/Views/CustomerView.php';
        break;
    }
}
?>