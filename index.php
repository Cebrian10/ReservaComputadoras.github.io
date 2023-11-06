<?php
require_once 'controller/Controller.php';

$controller = new Controller();

if (isset($_GET['op'])){
    $opcion = $_GET['op'];

    switch ($opcion){
        case "home": $controller->Home();
            break;
        case "login": $controller->Login();
            break;
        case "noRegistrado": $controller->NoRegistrado();
            break;
        case "register": $controller->Register();
            break;
        case "reserveList": $controller->ReserveList();
            break;
        case "reserve": $controller->Reserve();
            break;
        case "loginController": $controller->LoginController();
            break;        
        case "registerController": $controller->RegisterController();
            break;
        case "reserveController": $controller->ReserveController();
            break;
        case "logout": $controller->Logout();
            break;                      
        default: $controller->Home();
            break;
    }
}else {
    $controller->Home();
}
