<?php

namespace App\Domain\Services;

use App\Domain\Contracts\PostRepositoryInterface;
use App\Post;


class PostService
{
    /**
     * @var PostRepositoryInterface
     */
    private $repository;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Create Post
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes)
    {
        $attributes['user_id'] = auth()->id();
        $attributes['language_id'] = language();
        $attributes['status'] = "";
        $attributes['order'] = $attributes['order'] ?? 0;

        $post = $this->repository->create($attributes);

        return $post;
    }

    /**
     * Update Post
     * @param $postId
     * @param array $attributes
     * @return bool
     */
    public function update($postId, array $attributes){
        return $this->repository->update($postId, $attributes);
    }

    /**
     * Delete Post
     * @param $postId
     */
    public function delete($postId){
        return $this->repository->delete($postId);
    }

    /**
     * Edit Post
     * @param $postId
     */
    public function edit($postId){
        return $this->repository->edit($postId);
    }
}