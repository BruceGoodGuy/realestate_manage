<?php
namespace App\Interfaces\Post;

interface PostRepositoryInterface
{
    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getPostHost();
}
