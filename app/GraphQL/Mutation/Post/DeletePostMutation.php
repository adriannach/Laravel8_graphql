<?php

namespace App\GraphQL\Mutation\Post;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Auth;

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
        if($user = Auth::user()) {
            $post = Post::find($args['id']);

            if (!$post) {
                return null;
            }
            if((Auth::user()->id == $post->user_id) || (Auth::user()->role_id==1)) {
                Post::destroy($post->id);

                return $post;
            }
        }
        return null;
    }
}
