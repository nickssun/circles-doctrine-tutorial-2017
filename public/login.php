<?php

use Authentication\Entity\User;
use Infrastructure\Authentication\Repository\DoctrineUsers;

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineUsers($entityManager, $entityManager->getRepository(User::class));

$user = $users->get($_POST['emailAddress']);

$user->login($_POST['password'], function (string $password, string $hash) : bool { return password_verify($password, $hash); });

var_dump($user);