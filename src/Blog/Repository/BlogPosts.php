<?php

namespace Blog\Repository;

use Blog\Entity\BlogPost;
use Ramsey\Uuid\Uuid;

interface BlogPosts
{
    public function get(Uuid $id) : BlogPost;
    public function store(BlogPost $blogPost) : void;
}
