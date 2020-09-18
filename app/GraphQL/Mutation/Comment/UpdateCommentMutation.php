<?php

namespace App\GraphQL\Mutation\Comment;

use App\Models\Post;
use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class UpdateCommentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateComment'
    ];

    public function type(): type
    {
        return GraphQL::type('Comment');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'body' => [
                'name' => 'body',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return !!$currentUser;
    }

    public function resolve($root, $args)
    {
        if($user = Auth::user())
        {
            $com = Comment::find($args['id']);
            if (!$com) {
                return null;
            }


            $com->update([
                'body' => $args['body'],
            ]);

            return $com;
        }
        return null;
    }
}
