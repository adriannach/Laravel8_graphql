<?php

namespace App\GraphQL\Mutation\Post;

use App\Models\Category;
use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class UpdatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updatePost'
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
            ],
            'body' => [
                'name' => 'body',
                'type' => Type::nonNull(Type::string()),
            ],
            'category' => [
                'name' => 'category',
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        {
            if ($user = Auth::user()) {

                $post = Post::find($args['id']);

                if (!$post) {
                    return null;
                }

                if(Auth::user()->id == $post->user_id) {
                    $post->update([
                        'title' => $args['title'],
                        'body' => $args['body'],
                    ]);

                    $catId = $args['category'];
                    $categories = Category::find([$catId]);
                    $post->categories()->attach($categories);

                    return $post;
                }
            }
            return null;
        }
    }
}
