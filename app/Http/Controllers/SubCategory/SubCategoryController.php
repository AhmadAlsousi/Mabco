<?php

namespace App\Http\Controllers\SubCategory;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategory\createCategoryRequest;
use App\Http\Resources\SubCategory\CreateSubCategoryResesource;
use App\Http\Resources\SubCategory\IndexSubCategoryResesource;
use App\Http\Resources\SubCategory\TagSubCategoryResesource;
use App\Models\Subcategory;
use Illuminate\Http\Request;
// use App\Jobs\SubcategoryImgJob;
use App\Jobs\SubCatImageJob;
// use App\Enum\Image\
use App\Services\Subcategory\GetSubcategory;

class SubCategoryController extends APIController
{

    protected $services;
    public function __construct( GetSubcategory $service)
    {
        $this->service = $service;
    }
         /**
 * @group Subcategory
 */
    public function index(Request $request) {
        $query=Subcategory::query();
        $search=$request->input('search');
        $order=$request->input('orderBy');
        // $subcategory=Subcategory::paginate(5);
        // $subcategory=Subcategory::paginate(5);
        $subcategory=$this->service->getcategory($query,$search,$order)->paginate(5);
        return $this->sendResponce(IndexSubCategoryResesource::collection($subcategory),'a',200);
    }
     /**
 * @group Subcategory
 */
    public function create(createCategoryRequest $request)
    {
        $data = $request->validated();

    $subcategory = Subcategory::create([
        'name' => $data['name'],
        'category_id' => $data['category_id']
    ]);

    $path = $data['image']->store('temp');

    SubCatImageJob::dispatch(

        $subcategory->id,
        $path
    );

    return $this->sendResponce(
        CreateSubCategoryResesource::make($subcategory),
        's',
        201
    );
    }
         /**
 * @group Subcategory
 */
       public function filter() {
        $subcategory=Subcategory::all();
        return $this->sendResponce(TagSubCategoryResesource::collection($subcategory),'a',200);
    }
}
