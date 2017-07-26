<?php

namespace Authentication\Entity;

use Authentication\Repository\Users;

class User
{
    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $passwordHash;

    private function __construct(string $emailAddress, string $passwordHash)
    {
        $this->emailAddress = $emailAddress;
        $this->passwordHash = $passwordHash;
    }

    public static function register(string $emailAddress, string $password, Users $existingUsers, callable $hashPassword) : self
    {
        if ($existingUsers->has($emailAddress)) {
            throw new \DomainException(sprintf('User "%s" is already registered', $emailAddress));
        }

        return new self($emailAddress, $hashPassword($password));
    }

    public function login(string $password, callable $verifyPassword) : void
    {
        if (! $verifyPassword($password, $this->passwordHash)) {
            throw new \DomainException(sprintf('User "%s" failed authentication', $this->emailAddress));
        }
    }
}
