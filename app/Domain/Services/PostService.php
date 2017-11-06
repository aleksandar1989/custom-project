<?php

namespace App\Domain\Services;

use App\Domain\Contracts\PostRepositoryInterface;
use App\Language;
use App\Post;
use App\PostRelation;


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
        // Sync categories
        if(isset($attributes['categories'])){
            $post->terms()->sync($attributes['categories']);
        }

        if($attributes['relation']) {
            // get this post language
            $relation_lng = Language::find($post->language_id);

            foreach($attributes['relation'] as $language => $relation) {
                // create relation if not exist
                if($relation && !PostRelation::where('post_id', $post->id)->where('post_relation_id', $relation)->count()) {
                    // create relation this post - relation post
                    PostRelation::create([
                        'post_id' => $post->id,
                        'post_relation_id' => $relation,
                        'language' => $language
                    ]);

                    // create relation relation post - this post
                    PostRelation::create([
                        'post_id' => $relation,
                        'post_relation_id' => $post->id,
                        'language' => $relation_lng->code
                    ]);
                }
            }
        }

        return $post;
    }

    /**
     * Update Post
     * @param $postId
     * @param array $attributes
     * @return bool
     */
    public function update($postId, array $attributes){
        $post = $this->repository->getById($postId);

        // Sync categories
        if(isset($attributes['categories'])){
            $post->terms()->sync($attributes['categories']);
        }

        // get all post relations
        $relations = PostRelation::where('post_id', $post->id)->get();

        // deletion of posts that do not exist in input array
        foreach($relations as $rel) {
            if(!in_array($rel->post_relation_id, $attributes['relation'])) {
                PostRelation::where('post_id', $post->id)
                    ->where('post_relation_id', $rel->post_relation_id)
                    ->delete();

                PostRelation::where('post_relation_id', $post->id)
                    ->where('post_id', $rel->post_relation_id)
                    ->delete();
            }
        }

        if($attributes['relation']) {
            // get this post language
            $relation_lng = Language::find($post->language_id);

            foreach($attributes['relation'] as $language => $relation) {
                // create relation if not exist
                if($relation && !PostRelation::where('post_id', $post->id)->where('post_relation_id', $relation)->count()) {
                    // create relation this post - relation post
                    PostRelation::create([
                        'post_id' => $post->id,
                        'post_relation_id' => $relation,
                        'language' => $language
                    ]);

                    // create relation relation post - this post
                    PostRelation::create([
                        'post_id' => $relation,
                        'post_relation_id' => $post->id,
                        'language' => $relation_lng->code
                    ]);
                }
            }
        }

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