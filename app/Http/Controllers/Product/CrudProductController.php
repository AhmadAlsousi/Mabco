<?php

namespace App\Http\Controllers\Product;

use App\Enum\Image\ProductEnum;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\filterProductRequest;
use App\Http\Resources\Product\CreateProductResesource;
use App\Http\Resources\Product\ListProductResource;
use App\Models\Product;
use App\Services\Product\FilterProductService;
use Illuminate\Http\Request;
use App\Jobs\ProductGalleryJob;
USE App\Http\Resources\Product\DetailsProductResource;
class CrudProductController extends APIController
{

    protected $service;

    public function __construct(FilterProductService $service)
    {
        $this->service = $service;
    }
     /**
 * @group Products
 */

    public function index(Request $request)
    {

        $search=$request->input('search');
        // $search=$request->input('search');

        $tag=$request->input('tag');
        $min_price=$request->input('min_price');
        $max_price=$request->input('max_price');
        $sort=$request->input('sort');

// dd($request);

        $query=Product::query();

        $Product=  $this->service->get_products($query, $search,$tag,$min_price,$max_price,$sort)->paginate(5);

        return $this->sendResponce(ListProductResource::collection($Product),'All Product',200,true);

    }
         /**
 * @group Products
 */
    public function create(CreateProductRequest $request)
    {
$data = $request->validated();

$mainImage = $data['image']->store('temp');

$gallery = [];
if(empty($data['gallery'])){

}else{
    foreach ($data['gallery'] as $image) {
    $gallery[] = $image->store('temp');
}
}

// dd($gallery);
$Product=Product::create([
            'name'=>$data['name'],
            'price'=>$data['price'],
            'subcategory_id'=>$data['subcategory_id'],
            'color_image_products_id' => $data['color_image_products_id'] ?? null,
           



            ]);

ProductGalleryJob::dispatch(
    $Product->id,
    $mainImage,
    $gallery
);

        return $this->sendResponce(CreateProductResesource::make($Product),'Product Created',201);
    }
         /**
 * @group Products
 */
    public function show ($id){
    $Product=Product::findOrFail($id);
    return $this->sendResponce(DetailsProductResource::make($Product),'Product Show',200);
    }


}
