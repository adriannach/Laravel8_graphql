<?php
namespace App\GraphQL\Query\Comment;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CommentsQuery extends Query //zapytania graphql
{
    protected $attributes = [//określenie atrybutu
        'name' => 'comment',
    ];

    public function type(): Type//określenie typu
    {
        return Type::listOf(GraphQL::type('Comment'));
    }

    public function resolve($root, $args)//zwrócenie wszystkich danych dla komentarza
    {
        return Comment::all();
    }
}
