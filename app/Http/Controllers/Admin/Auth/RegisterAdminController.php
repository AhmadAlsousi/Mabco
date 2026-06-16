<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\APIController;

use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class RegisterAdminController extends APIController
{
      /**
 * @group Admin Authentication

 */
    public function register(AdminRegisterRequest $request){
        $data=$request->validated();
        $admin=Admin::create($data);
        return $this->sendResponce($data,'success',201);

    }
}
