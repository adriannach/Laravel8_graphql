<?php

namespace App\GraphQL\Mutation\Comment;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Auth;

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
        $com = Comment::find($args['id']);

        if (!$com) {
            return null;
        }

        if((Auth::user()->id == $com->user_id) || (Auth::user()->role_id==1)) {

            Comment::destroy($com->id);

            return $com;

        }
        return null;
    }
}
