<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Laravel\Passport\RefreshTokenRepository;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        private RefreshTokenRepository $refreshTokenRepository
    ) {
    }

    /**
     * Get logged in user details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return response()->success(new UserResource($request->user()));
    }

    /**
     * Logout by revoking the token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);

        return response()->success(['message' => trans('auth.logout')]);
    }
}
