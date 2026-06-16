<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use App\Enum\Image\ProductEnum;
use App\Jobs\ImageProductJob;
// use App\Http\Controllers\APIController;

use App\Http\Requests\Property\PropertyRequest;
// ColorImageRequest
use App\Http\Requests\ColorImage\ColorImageRequest;
use App\Models\ColorImageProduct;
use App\Models\Property;
// use App\Http\Resources\Property\PropertyResource;
// use App\Http\Resources\Color\ColorImageProductResource;
// use App\Http\Resources\Product\DetailsProductResource;
// use App\Http\Resources\Product\Color\IndexColorResource;
// use App\Http\Resources\Product\CreateProductResesource;
// use APIController;

class CrudPropertyController extends APIController
{
          /**
 * @group Property

 */
 public function createProperty(PropertyRequest $request)
 {
    $data=$request->validated();
    // return $data;
    $property = Property::create($data);
    return $this->sendResponce($property, 'Property created successfully');
 }
 public function updateProperty(Request $request, $id)
 {
  $property = Property::find($id);
  $property->update($request->all());
  return response()->json($property);
 }
 public function deleteProperty($id)
 {
  $property = Property::find($id);
  $property->delete();
  return response()->json($property);
 }
}
