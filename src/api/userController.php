<?php
session_start();
if(!empty($_POST)){
    $request = $_POST;
}else{
    $request = $_GET;
}

if(!isset($request['action'])){
    echo json_encode(['error' => 'No action specified']);
    exit;
}else{
    require_once "classes/user.php";

    $_SESSION['userClass'] = new User();
    switch($request['action']){
        case 'login': 
            if($_SESSION['userClass']->logIn($request)){
                header('Location: ../../public/profile.php');
            }else{
                header('Location: ../../public/login.php');
            }
        break;
        case 'register': $_SESSION['userClass']->register($request); break;

        default: echo json_encode(['error' => 'No such action']);
    }
}