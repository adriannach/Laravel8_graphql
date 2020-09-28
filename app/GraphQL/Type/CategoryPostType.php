<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryPostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CategoryPost',
        'description' => 'kategoria postu'
    ];

    public function fields(): array
    {
        return [
            'post_id' => [
                'type' => Type::nonNull(GraphQL::type('Post')),
                'description' => 'Post'
            ],
            'category_id' => [
                'type' => Type::nonNull(GraphQL::type('Category')),
                'description' => 'Post'
            ],
        ];
    }
}
