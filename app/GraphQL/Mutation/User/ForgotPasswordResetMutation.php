<?php

namespace App\GraphQL\Mutation\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Rebing\GraphQL\Support\Mutation;

class ForgotPasswordResetMutation extends Mutation
{
    protected $attributes = [
        'name' => 'forgotPasswordReset'
    ];

    public function type(): type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'token' => [
                'name' => 'token',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $emailToken = DB::table('password_resets')->where('email', $args['email'])->first();
        $token = $emailToken->token;
        if($token = Hash::check($args['token'], $token))
        {
            $user = User::where('email', $args['email'])->first();

            $user->password = bcrypt($args['password']);
            $user->save();

            DB::table('password_resets')->where('email', $args['email'])->delete();

            return auth()->login($user);
        }
        else
        {
            return null;
        }
    }
}
