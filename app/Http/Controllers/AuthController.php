<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\User\UserService;
use App\Http\Resources\User\Resource;
use App\Models\User;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = $this->userService->createUser($request->all());

        return $this->successResponse([
            'user' => new Resource($user),
            'token' => $user->createToken('auth-token')->plainTextToken
        ], Response::HTTP_CREATED);
    }

    /**
     * Authenticate user and generate a new JWT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (! $user = $this->userService->loginCheck($request->all())) {
            return $this->errorResponse(
                'Bad credentials',
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $this->successResponse([
            'user' => new Resource($user),
            'token' => $user->createToken('auth-token')->plainTextToken
        ], Response::HTTP_OK);
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if (! $user instanceof User) {
            return $this->errorResponse(
                'unauthorized',
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user->tokens()->delete();

        return $this->successResponse([
            'message' => 'Logged out'
        ]);
    }
}
