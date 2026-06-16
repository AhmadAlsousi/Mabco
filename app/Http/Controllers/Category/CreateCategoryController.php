<?php

namespace App\Http\Controllers\Category;
use Illuminate\Support\Facades\Log;
use App\Enum\Image\CategoryEnum;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Resources\Category\CreateCategoryResesource;
use App\Http\Resources\Category\IndexCategoryResesource;
// use App\Http\Resources\Category\IndexCategoryResesource;
use App\Services\Category\FilterCategoryServices;
// use Illuminate\Http\Request;

use App\Jobs\ImageCategoryJob ;

use App\Models\Category;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CreateCategoryController extends APIController
{
 /**
 * @group Category

  * @unauthenticated
    */

    protected $services;
    public function __construct(FilterCategoryServices $service)
    {
        $this->service = $service;
    }
 /**
 * @group Category
   * @unauthenticated
 */
    public function index(Request $request){
        $query=Category::query();
        $search=$request->input('search');
        $order=$request->input('orderBy');


      $category=$this->service->getcategory($query,$search,$order)->paginate(1);
        return $this->sendResponce(IndexCategoryResesource::collection($category),'نجاح',200,true);
    }
 /**
 * @group Category
 */

    public function create(CreateCategoryRequest $request)
    {
           $data = $request->validated();
// dd($data);
           $category = Category::create([
              'name' => $data['name']
                                      ]);
           $tempPath = $data['image']->store('temp');

// dd($tempPath);

           ImageCategoryJob::dispatch($category->id, $tempPath)->onQueue('default');
Log::info('helllllo');


        return $this->sendResponce('ouccess',CreateCategoryResesource::make($category),200,false);



    }

}
