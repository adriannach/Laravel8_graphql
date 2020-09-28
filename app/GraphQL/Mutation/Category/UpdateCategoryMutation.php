<?php

namespace App\GraphQL\Mutation\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class UpdateCategoryMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateCategory'
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
        if(($user = Auth::user()) && (Auth::user()->role_id==1))
        {
            $cat = Category::find($args['id']);

            if (!$cat) {
                return null;
            }

            $cat->update([
                'title' => $args['title'],
                'description' => $args['description'],
            ]);
            return $cat;
        }
        return null;
    }
}
