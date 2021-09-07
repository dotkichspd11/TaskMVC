<?php 
require_once './MVC/Models/config.php';
$db = new DB();
$db->connect();

if(isset($_GET['controller'])){
    $controller = $_GET['controller'];
}else {
    $controller = '';
}

switch($controller){
    case 'customer' :{
        require_once './MVC/Controllers/CustomerController.php';
        break;
    }
    case 'user' :{
        require_once './MVC/Controllers/UserController.php';
        break;
    }
    
    default :{
        require_once 'login.php';
        break;
    }
}
?>