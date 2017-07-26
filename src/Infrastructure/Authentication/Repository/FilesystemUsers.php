<?php

namespace Infrastructure\Authentication\Repository;

use Authentication\Entity\User;
use Authentication\Repository\Users;

final class FilesystemUsers implements Users
{
    /**
     * @var string
     */
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function has(string $emailAddress) : bool
    {
        return file_exists($this->directory . '/' . base64_encode($emailAddress));
    }

    public function get(string $emailAddress) : User
    {
        return unserialize(file_get_contents($this->directory . '/' . base64_encode($emailAddress)));
    }

    public function store(User $user) : void
    {
        $reflectionEmail = new \ReflectionProperty(User::class, 'emailAddress');

        $reflectionEmail->setAccessible(true);

        file_put_contents($this->directory . '/' . base64_encode($reflectionEmail->getValue($user)), serialize($user));
    }
}