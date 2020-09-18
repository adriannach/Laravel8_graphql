<?php

namespace App\GraphQL\Type;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Comment',
        'description' => 'komentarz o postu'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Comment Id'
            ],
            'user' => [
                'type' => Type::nonNull(GraphQL::type('User')),
                'description' => 'User created comment'
            ],
            'post' => [
                'type' => Type::nonNull(GraphQL::type('Post')),
                'description' => 'Post'
            ],
            'body' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Comment Body'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Comment create date'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Comment update date'
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
