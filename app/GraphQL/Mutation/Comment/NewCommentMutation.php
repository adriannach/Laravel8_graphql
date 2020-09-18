<?php

namespace App\GraphQL\Mutation\Comment;

use GraphQL;
use App\Models\Post;
use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class NewCommentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newComment'
    ];

    public function type(): type
    {
        return GraphQL::type('Comment');
    }

    public function args(): array
    {
        return [
            'post_id' => [
                'name' => 'post_id',
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

            $post = Post::find($args['post_id']);

            $com = new Comment();
            $com->user_id = $user->id;
            $com->body = $args['body'];

            $post->comments()->save($com);

            return $com;
        }
        return null;
    }
}
