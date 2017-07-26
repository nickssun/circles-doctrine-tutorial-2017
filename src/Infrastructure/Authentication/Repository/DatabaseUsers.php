<?php
/**
 * Created by PhpStorm.
 * User: admin-php2
 * Date: 26.07.17
 * Time: 12:04
 */

use Doctrine\ORM\EntityManager;

class DatabaseUsers implements \Authentication\Repository\Users {


    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function has(string $emailAddress): bool
    {
        // TODO: Implement has() method.
    }

    public function get(string $emailAddress): \Authentication\Entity\User
    {
        // TODO: Implement get() method.
    }

    public function store(\Authentication\Entity\User $user): void
    {
        $this->entityManager->persist($user);
    }
}