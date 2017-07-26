<?php

use Authentication\Entity\User;
use Blog\Entity\BlogPost;
use Infrastructure\Authentication\Repository\DoctrineUsers;
use Infrastructure\Blog\Repository\DoctrineBlogPosts;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

/* @var $entityManager \Doctrine\ORM\EntityManager */
$entityManager = require __DIR__ . '/../bootstrap.php';

$users = new DoctrineUsers($entityManager, $entityManager->getRepository(User::class));
$blogPosts = new DoctrineBlogPosts($entityManager, $entityManager->getRepository(BlogPost::class));

$blogPost = null;

$entityManager->transactional(function () use ($users, $blogPosts, & $blogPost) {
    $user = $users->get($_POST['emailAddress']);
    $blogPost = $blogPosts->get(Uuid::fromString($_POST['blogPostId']));

    $blogPost->comment($user, $_POST['contents'], new \DateTime());

//    $blogPosts->store($blogPost);
});

\Doctrine\Common\Util\Debug::dump($blogPost);
