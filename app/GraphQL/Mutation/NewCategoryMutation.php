<?php

namespace App\GraphQL\Mutation;

use App\Models\Category;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class NewCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newCategory'
    ];

    public function type(): type
    {
        return GraphQL::type('Category');
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if($user = Auth::user())
        {
            $cat = new Category();

            $cat->title = $args['title'];
            $cat->description = $args['description'];

            $cat->save();

            return $cat;
        }
        return null;
    }
}
