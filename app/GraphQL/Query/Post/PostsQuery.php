<?php
namespace App\GraphQL\Query\Post;

use App\Models\Post;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostsQuery extends Query //zapytania graphql
{
    protected $attributes = [//określenie atrybutu
        'name' => 'post',
    ];

    public function type(): Type//określenie typu
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args)//zwrócenie wszystkich danych dla komentarza
    {
        return $posts = Post::all();
    }
}
