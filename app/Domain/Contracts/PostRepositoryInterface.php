<?php

namespace App\Domain\Contracts;

use App\Post;

interface PostRepositoryInterface
{

    /**
     * Create Post
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes);

    /**
     * @param $postId
     * @param array $attributes
     * @return bool
     */
    public function update($postId, array $attributes);

    /**
     * @param $postId
     * @return bool
     */
    public function delete($postId);

}
