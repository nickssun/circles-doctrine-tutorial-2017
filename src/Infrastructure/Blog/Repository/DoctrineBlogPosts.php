<?php

namespace Infrastructure\Blog\Repository;

use Blog\Entity\BlogPost;
use Blog\Repository\BlogPosts;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Ramsey\Uuid\Uuid;

final class DoctrineBlogPosts implements BlogPosts
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    public function __construct(ObjectManager $manager, ObjectRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    public function get(Uuid $id) : BlogPost
    {
        return $this->repository->find((string) $id);
    }

    public function store(BlogPost $blogPost) : void
    {
        $this->manager->persist($blogPost);
    }
}