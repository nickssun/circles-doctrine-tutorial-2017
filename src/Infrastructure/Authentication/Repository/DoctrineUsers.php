<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Users;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

final class DoctrineUsers implements Users
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    public  function __construct(ObjectManager $manager, ObjectRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    public function has(string $emailAddress) : bool
    {
        return (bool) $this->repository->find($emailAddress);
    }

    public function get(string $emailAddress) : User
    {
        return $this->repository->find($emailAddress);
    }

    public function store(User $user) : void
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }
}