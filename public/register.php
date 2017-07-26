<?php

use Authentication\Entity\User;
use Infrastructure\Authentication\Repository\FilesystemUsers;

require_once __DIR__ . '/../vendor/autoload.php';


$users = new FilesystemUsers(__DIR__ . '/../data/users');

// @TODO form validation and pretty messages?

$users->store(User::register($_POST['emailAddress'], $_POST['password'], $users, function (string $password) : string {
    return password_hash($password, \PASSWORD_DEFAULT);
}));

var_dump($users->get($_POST['emailAddress']));
