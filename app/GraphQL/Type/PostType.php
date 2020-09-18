<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'Code bit'
    ];

    public function fields():array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Post id'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'User created this post'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Post title'
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'Post body'
            ],
            'category' => [
                'type' => Type::nonNull(GraphQL::type('Category')),
                'description' => 'Category'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Created date'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Updated date'
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }
}
