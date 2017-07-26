<?php

namespace Blog\Entity;

use Authentication\Entity\User;
use Ramsey\Uuid\Uuid;

class BlogPost
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var User
     */
    private $author;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $contents;

    private function __construct(string $id, User $author, string $title, string $contents)
    {
        $this->id       = $id;
        $this->author   = $author;
        $this->title    = $title;
        $this->contents = $contents;
    }

    public static function post(User $author, string $title, string $contents) : self
    {
        return new self((string) Uuid::uuid4(), $author, $title, $contents);
    }

    public function comment($bar) : void
    {

    }
}
