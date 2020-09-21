<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'kategoria'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Category id'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Category id'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Category description'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Category create date'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Category update date'
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
