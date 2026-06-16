<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends APIController
{
     /**
 * @group Admin Authentication

 */
    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();

        $user = Admin::where('email', $data['email'])->first();
        if (! $user) {
            return $this->sendError('Email not found');
        }

        if (! Hash::check($data['password'], $user->password)) {
            return $this->sendError('The password is incorrect');
        }
        // if ($user->email_verified_at == null) {
        //     return $this->sendResponce('You have not yet confirmed your account.', 200);
        // }
        $token = $user->access_token_admin = $user->createToken('access_token_admin')->plainTextToken;
        $user->save();
        return $this->sendResponce($user, 'Login successfully', 200)->cookie(
            'token1',
            $token,
            60,        // مدة الكوكي بالدقائق
            '/',       // المسار
            null,      // الدومين (null = الدومين الحالي my-app.test)
            true,      // Secure = true (لن تُرسل إلا عبر HTTPS)
            true,      // HttpOnly = true (لا يمكن قراءتها من JavaScript)
            false,     // raw
            'Lax'      // SameSite
        );;
    }
 /**
 * @group csrf token

 */
    public function csrf()
    {
        $token = Str::random(40);

        Cache::put('csrf_' . $token, true, 60);

        return response()->json([
            'csrf_token' => $token
        ]);
    }
    //


    //
}
