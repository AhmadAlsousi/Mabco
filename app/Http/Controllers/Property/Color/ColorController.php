<?php

namespace App\Http\Controllers\Property\Color;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Color\CreateColorPhRequest;
use App\Models\Color;
use App\Http\Controllers\APIController;
use App\Http\Resources\Color\ColorListResource;

//

class ColorController extends APIController
{
             /**
 * @group Color
 */
     public function index(){
        $color=Color::all();
        return $this->sendResponce(ColorListResource::collection($color),$color,200);
    }
         /**
 * @group Color
 */
    public function create(CreateColorPhRequest $request){
        // $data=$request->validated();
        $data=$request->validated();

        $color=Color::create($data);
        return $this->sendResponce('s',$data,200);


    }
}
