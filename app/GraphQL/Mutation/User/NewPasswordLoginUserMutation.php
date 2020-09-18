<?php

namespace App\GraphQL\Mutation\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Auth;

class NewPasswordLoginUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newPasswordLogin'
    ];

    public function type(): type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'new_password' => [
                'name' => 'new_password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        $token = auth()->attempt($credentials);

        if (!$token) {
            throw new \Exception('Unauthorized!');
        }
        $user = Auth::user();

        $user->password = bcrypt($args['new_password']);
        $user->save();

        return auth()->login($user);
    }
}
