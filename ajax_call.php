<?php

header("Access-Control-Allow-Origin: *");
include_once 'function.php';

$is_error = 0;
$comeback = array('result' => 'fail', 'message' => 'Opps! Bad request call!');

if (isset($_POST['routine_name']) && $_POST['routine_name']) {
 
    $obj_client_functions = new client_functions();
    $comeback = call_user_func(array($obj_client_functions,$_POST['routine_name']));
    echo json_encode($comeback);
    exit;
} else {
    $is_error++;
}
if ($is_error > 0) {
    echo json_encode($comeback);
    exit;
}