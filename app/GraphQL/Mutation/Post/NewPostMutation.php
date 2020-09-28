<?php

namespace App\GraphQL\Mutation\Post;

use App\Models\Category;
use Rebing\GraphQL\Support\Facades\GraphQL;
use App\Models\Post;
use App\Models\CategoryPost;
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
            'category' => [
                'name' => 'category',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if(Auth::user())
        {
            $catId = $args['category'];
            $categories = Category::findOrFail([$catId]);
            if(($user = Auth::user()) && $categories ) {

                $post = new Post();

                $post->user_id = $user->id;
                $post->title = $args['title'];
                $post->body = $args['body'];

                $post->save();

                $post->categories()->attach($categories);

                return $post;
            }
        }
        return null;
    }
}
