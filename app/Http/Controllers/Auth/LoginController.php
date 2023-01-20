<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group Auth
 */
class LoginController extends Controller
{
    /**
     * Login
     *
     * @unauthenticated
     *
     * @bodyParam email string required  Example: a@a.a
     * @bodyParam password string required  Example: password
     *
     * @response status=200 scenario=success
     * {
     *     "user": {
     *         "id": 11,
     *         "name": "Admin",
     *         "email": "a@a.a",
     *         "email_verified_at": "2022-12-20T17:16:43.000000Z",
     *         "created_at": "2022-12-20T17:16:43.000000Z",
     *         "updated_at": "2022-12-20T17:16:43.000000Z"
     *     },
     *     "token": "2|esqlJ2VkZUpGQTVyeCLK7ez1owzkRe0zmdgBhRS7"
     * }
     *
     * @response status=401 scenario=bad_credentials
     * {
     *     "message": "Bad credentials"
     * }
     */
    public function __invoke(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required|string']);

        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return response(['message' => 'Bad credentials'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response(['user' => $user, 'token' => $token], 201);
    }
}
