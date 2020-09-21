<?php

namespace App\GraphQL\Query\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CategoryQuery extends Query //zapytania graphql
{
    protected $attributes = [//okreslenie atrybutu
        'name' => 'category',
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Category');
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
        return Category::findOrFail($args['id']);
    }
}
