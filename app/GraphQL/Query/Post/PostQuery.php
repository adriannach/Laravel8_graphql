<?php

namespace App\GraphQL\Query\Post;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostQuery extends Query //zapytania graphql
{
    protected $attributes = [//okreslenie atrybutu
        'name' => 'post',
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Post');
    }

    public function args():array//wyszukanie po id - wymagane
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Post::findOrFail($args['id']);
    }
}
