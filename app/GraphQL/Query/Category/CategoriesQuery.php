<?php
namespace App\GraphQL\Query\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoriesQuery extends Query //zapytania graphql
{
    protected $attributes = [//określenie atrybutu
        'name' => 'category',
    ];

    public function type(): Type//określenie typu
    {
        return Type::listOf(GraphQL::type('Category'));
    }

    public function resolve($root, $args)//zwrócenie wszystkich danych dla komentarza
    {
        return Category::all();
    }
}
