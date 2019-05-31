<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('model.class.php');

$model = new Model();

$data = [];

if (!empty($_REQUEST['email']) and !empty($_REQUEST['password'])) {
    $user = $model->verif_password($_REQUEST['email'], !password_verify($_REQUEST['password'], $user['password']));

    if (!empty($user)) {
        $data[] = $user;
    }
}

echo json_encode($data);