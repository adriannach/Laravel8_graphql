<?php

namespace App\GraphQL\Mutation;

use GraphQL;
use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Auth;
use Rebing\GraphQL\Support\Mutation;

class NewPostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newPost'
    ];

    public function type(): type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
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
        $user = Auth::user();
        $post = new Post();

        $post->user_id = $user->id;
        $post->title = $args['title'];
        $post->body = $args['body'];
        $post->save();

        return $post;
    }
}
