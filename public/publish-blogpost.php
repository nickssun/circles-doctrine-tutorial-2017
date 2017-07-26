<?php

use Authentication\Entity\User;
use Blog\Entity\BlogPost;
use Infrastructure\Authentication\Repository\DoctrineUsers;
use Infrastructure\Blog\Repository\DoctrineBlogPosts;

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineUsers($entityManager, $entityManager->getRepository(User::class));
$blogPosts = new DoctrineBlogPosts($entityManager, $entityManager->getRepository(BlogPost::class));

$blogPost = null;

$entityManager->transactional(function () use ($users, $blogPosts, & $blogPost) {
    $user = $users->get($_POST['emailAddress']);

    $blogPosts->store($blogPost = BlogPost::post($user, $_POST['title'], $_POST['contents']));
});

var_dump($blogPost);
