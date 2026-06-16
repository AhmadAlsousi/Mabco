<?php

namespace App\Http\Controllers\Users;

use App\Events\UserRegistered;
use App\Http\Controllers\APIController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\User\Auth\RefreshRequest;
use App\Http\Resources\LoginResesource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class LoginController extends APIController
{
    /**
 * @group Auth Customer
  * @unauthenticated
    */

    public function login(LoginRequest $request)
    {

        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();


        if (! $user) {
            return $this->sendError('Email not found');
        }

        if (! Hash::check($data['password'], $user->password)) {
            return $this->sendError('The password is incorrect');
        }
        if ($user->email_verified_at == null) {
            return $this->sendResponce('You have not yet confirmed your account.', 200);
        }

        $user->token_user = $user->createToken(
            'token_admin-ss',
            ['*'],
            now()->addMinutes(10) // هنا يتم ملء expires_at تلقائياً
        )->plainTextToken;
        $user->save();
        return $this->sendResponce(LoginResesource::make($user), 'Login successfully', 200);
    }
 /**
 * @group Auth Customer
  * @unauthenticated
    */
    public function logout()
    {
         $token = request()->bearerToken();

    if (! $token) {
        return $this->sendError('Token not provided', 400);
    }

    // إيجاد التوكن في جدول personal_access_tokens
    $tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

    if (! $tokenModel) {
        return $this->sendError('Invalid token', 401);
    }

    // جلب المستخدم
    $user = $tokenModel->tokenable;

    // حذف التوكن من جدول personal_access_tokens
    $tokenModel->delete();

    // حذف التوكن من جدول users
    $user->token_user = null;
    $user->save();

    return $this->sendResponce(null, 'Logged out successfully', 200);


    }
     /**
 * @group Auth Customer
  * @unauthenticated
    */
    public function refresh(RefreshRequest $request)
    {



        // جلب التوكن من جدول personal_access_tokens
        $token_user = \Laravel\Sanctum\PersonalAccessToken::findToken($request['token']);
        // return $this->sendResponce($token_user->expires_at, 'Login successfully', 200);

        // return $token_user->expires_at;
        if (! $token_user) {
            return $this->sendError('Invalid refresh token', 401);
        }
         if ($token_user->expires_at && now()->lessThan($token_user->expires_at)) {

        // التوكن ما زال صالحًا
        return $this->sendResponce([
            'message' => 'Token is still valid',
            'expires_at' => $token_user->expires_at
        ], 'Token still valid', 200);
    }


        // التحقق من انتهاء صلاحية التوكن
        if ($token_user->expires_at && now()->greaterThan($token_user->expires_at)) {

            // حذف التوكن المنتهي
            $token_user->delete();

            // return $this->sendError('Refresh token expired', 401);
        }

        // جلب المستخدم المرتبط بالتوكن
        $user = $token_user->tokenable;

        if (! $user) {
            return $this->sendError('User not found', 404);
        }

        // حذف جميع التوكنات القديمة
        $user->tokens()->delete();

        // إنشاء refresh token جديد بصلاحية 10 دقائق
        $new_refresh = $user->createToken(
            'token_admin-ss',
            ['*'],
            now()->addMinutes(10) // هنا يتم ملء expires_at تلقائياً
        );


        // حفظ التوكن الجديد في جدول users
        // $user->token_user = $token;

        $user->token_user = $new_refresh->plainTextToken;
        $user->save();

        return $this->sendResponce(LoginResesource::make($user), 'Token refreshed successfully', 200);
    }
}
