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
                'description' => 'The id of a bit'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'The user that posted a bit'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'tytul'
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'tresc'
            ],
            'category' => [
                'type' => Type::nonNull(GraphQL::type('Category')),
                'description' => 'The category id'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was created'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a bit was updated'
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
