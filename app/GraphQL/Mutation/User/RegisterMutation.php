<?php

namespace App\GraphQL\Mutation\User;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use App\Models\User;

class RegisterMutation extends Mutation
{
    protected $attributes = [
        'name' => 'signUp'
    ];

    public function type(): type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {

        $user = new User();

        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = bcrypt($args['password']);
        $user->role_id=2;
        $user->save();
        if($user['id']==1)
        {
            $user->role_id=1;
        }
        $user->save();
        // generate token for user and return the token
        return auth()->login($user);
    }
}
