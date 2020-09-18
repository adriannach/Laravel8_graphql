<?php

namespace App\GraphQL\Mutation\Comment;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteCommentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteComment'
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Comment');
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
        $post = Comment::find($args['id']);

        if (!$post) {
            return null;
        }
        Comment::destroy($post->id);

        return $post;
    }
}
