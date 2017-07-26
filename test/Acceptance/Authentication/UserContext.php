<?php

namespace Acceptance\Authentication;

use Authentication\Entity\User;
use Authentication\Repository\Users;
use Behat\Behat\Context\Context;

final class UserContext implements Context
{
    /**
     * @var Users
     */
    private $existingUsers;

    /**
     * @var User
     */
    private $user;

    /**
     * @Given there are no registered users
     */
    public function there_are_no_registered_users() : void
    {
        $this->existingUsers = new class implements Users
        {
            public function has(string $emailAddress) : bool
            {
                return false;
            }

            public function get(string $emailAddress) : User
            {
                throw new \Exception('Not implemented');
            }

            public function store(User $user) : void
            {
                throw new \Exception('Not implemented');
            }
        };
    }

    /**
     * @When a user registers with the website
     */
    public function a_user_registers_with_the_webiste() : void
    {
        $this->user = User::register('foo@example.com', 'bar', $this->existingUsers, function (string $password) : string {
            return 'hashed' . $password;
        });
    }

    /**
     * @Then the user can log into the website
     */
    public function the_user_can_log_into_the_website() : void
    {
        $this->user->login('bar', function (string $password, string $hash) {
            return $hash === ('hashed' . $password);
        });
    }
}