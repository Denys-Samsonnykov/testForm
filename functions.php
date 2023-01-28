<?php

function checkEmail(array $arrayWithUsers, array $postArray): ?string
{
    $registeredEmails = [];
    $file = $_SERVER['DOCUMENT_ROOT'] . '/log-file.log';
    foreach($arrayWithUsers as $user) {
        $registeredEmails[] = $user['email'];
    }
    if (in_array($postArray['email'], $registeredEmails, true)) {
        $message = ' Same email already exist, please try another. ';
        file_put_contents($file , $message, FILE_APPEND);
        return $message;
    }  file_put_contents($file, ' Your email address is unique. ', FILE_APPEND);

    return null;
}

function validation(array $post): array
{
    $errors = [];

    if (empty($post['name'])) {
        $errors['name'] = 'Name is required.';
    }

    if (empty($post['email'])) {
        $errors['email'] = 'Email is required.';
    }elseif (!strpos($post['email'], '@')) {
        $errors['email'] = 'Email  does not contain @';
    }

    if (empty($post['password']) || empty($post['confirmPassword'])) {
        $errors['password'] = 'Fields with password are required.';
    }elseif ($post['password'] !== $post['confirmPassword']) {
        $errors['password'] = 'Please use the same passwords.';
    }

    return $errors;
}
