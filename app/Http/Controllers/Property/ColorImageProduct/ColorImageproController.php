<?php

namespace App\Http\Controllers\Property\ColorImageProduct;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use App\Enum\Image\ProductEnum;
use App\Http\Requests\ColorImage\ColorImageRequest;
use App\Models\ColorImageProduct;
use App\Http\Resources\Color\ColorImageProductResource;
// use App\Jobs\ImageProductJob;
use App\Jobs\ImgColorJob;

class ColorImageproController extends APIController
{
         /**
 * @group Color_Image
 */
    public function index(){
        $colorImage=ColorImageProduct::all();

        return $this->sendResponce( 'Color Image List',ColorImageProductResource::collection($colorImage),200);
    }
             /**
 * @group Color_Image
 */
    public function create(ColorImageRequest $request){
        $data=$request->validated();
        $colorImage=ColorImageProduct::create();
        $tempPath = $data['image']->store('temp_color_img');
        dispatch( new ImgColorJob($colorImage->id,$tempPath));
        $colorImage->colors()->attach($data['colors_id']);
        // $colorImage->addMedia($data['image'])->toMediaCollection(ProductEnum::GALLERY->value);
        return $this->sendResponce('Product Created',$colorImage,201);


    }
}
