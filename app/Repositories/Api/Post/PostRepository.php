<?php

namespace App\Repositories\Api\Post;

use App\Models\Post;
use App\Repositories\Api\Post\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return  $this->post
                ->get();
    }

    public function getById($id)
    {
        return  $this->post
                ->find($id);
    }

    public function save($data)
    {
        $post           = $this->post;

        $post->title    = $data['title'];
        $post->content  = $data['content'];

        $post->save();

        return $post->fresh();
    }

    public function update($data, $id)
    {
        $post           = $this->post->find($id);

        $post->title    = $data['title'];
        $post->content  = $data['content'];

        $post->save();

        return $post;
    }

    public function delete($id)
    {
        $post = $this->post->findorFail($id);
        
        $post->delete();

        return $post;
    }
}