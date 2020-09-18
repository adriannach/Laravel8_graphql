<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'typ danych',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User name'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User email'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'User created date'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'User updated date'
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
