<?php

namespace App\GraphQL\Mutation\Post;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeletePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deletePost'
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Post');
    }

    public function args() :array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $post = Post::find($args['id']);

        if (!$post) {
            return null;
        }
        Post::destroy($post->id);

        return $post;
    }
}
