<?php

namespace App\GraphQL\Query\Comment;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CommentQuery extends Query //zapytania graphql
{
    protected $attributes = [//okreslenie atrybutu
        'name' => 'comment',
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Comment');
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
        return Comment::findOrFail($args['id']);
    }
}
