<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/data.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$errors = [];
$data = [];

$validationResult = validation($_POST);
if($validationResult) {
    $errors = $validationResult;
}

$message = checkEmail($users, $_POST);
if($message){
    $errors['email'] = $message;
}


if ($errors) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'You have successfully registered!';
}

echo json_encode($data);

