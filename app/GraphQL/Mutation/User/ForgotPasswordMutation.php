<?php

namespace App\GraphQL\Mutation\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Mail;
use Rebing\GraphQL\Support\Mutation;

class ForgotPasswordMutation extends Mutation
{
    protected $attributes = [
        'name' => 'forgotPassword'
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
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if($user = User::where('email', $args['email'])->first())
        {

            $password_broker = app(PasswordBroker::class);

            $token = $password_broker->createToken($user);

            Mail::send('email.ForgotPassword', ['token' => $token]
                , function ($m) use ($user) {
                $m->from('anachtygal@softfusion.pl', 'Aplikacja laravel');
                $m->to($user->email, $user->name)->subject('Zmień hasło!');
            });
            return $token;
        }
        return null;
    }
}
