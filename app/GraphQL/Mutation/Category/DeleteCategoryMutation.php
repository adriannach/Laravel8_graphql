<?php

namespace App\GraphQL\Mutation\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;


class DeleteCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteCategory'
    ];

    public function type(): Type//określenie typu
    {
        return GraphQL::type('Category');
    }

    public function args() :array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $cat = Category::find($args['id']);

        if (!$cat) {
            return null;
        }

        Category::destroy($cat->id);

        return $cat;
    }
}
