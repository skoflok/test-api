<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        /**
         * [LH REVIEW] Если валидация - это хорошо
         * Валидация на уникальность -- очень хорошо.
         */
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $response = [
            'user' => $user,
        ];

        /**
         * [LH REVIEW] В АПИ обмен по json response()->json();
         */
        return response($response, 201);
    }

    public function getToken(Request $request)
    {
        /**
         * [LH REVIEW] В readme.md указано | `token_name` | `string` | `any` |
         * Прям любой? Даже "token_name": "abaracddabra-teribakta-rebakta" :)
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            /**
             * [LH REVIEW] Вряд ли пользователи захотят видеть "something went wrong" с 500. Лучше обработать и отдать 401 с текстом unauthorized.
             */
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        /**
         * [LH REVIEW] что будет если токен нейм будет прям ЛЮБЫМ? Ошибка, ничего, 403 ответ?
         */
        $token = $user->createToken($request->token_name)->plainTextToken;

        $response =  [
            'token' => $token
        ];

        /**
         * [LH REVIEW] Опять же, хотелось бы в json
         */
        return response($response, 201);
    }
}
