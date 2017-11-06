<?php

namespace App\Domain\Repositories;

use App\Domain\Contracts\PostRepositoryInterface;
use App\Post;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    private $model;


    /**
     * PostRepository constructor.
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritdoc
     */
    public function update($postId, array $attributes) {
        return $this->model->find($postId)->update($attributes);
    }

    /**
     * @inheritdoc
     */
    public function getById($postId)
    {
        return $this->model->find($postId);
    }

    /**
     * @inheritdoc
     */
    public function delete($postId) {
        return $this->model->findOrFail($postId)->delete();
    }

    /**
     * @inheritdoc
     */
    public function edit($postId) {
        return $this->model->find($postId);
    }

}