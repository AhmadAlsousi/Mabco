<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\APIController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\AddProductsRequest;
use App\Http\Requests\Offer\OfferRequest;
use App\Http\Resources\Offer\ListOfferResource;
use App\Http\Resources\Offer\OfferShowResource;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends APIController
{
         /**
 * @group Offer
 */
    public function index(OfferRequest $request) {
        $data=$request->validated();
       $offers=Offer::all();
        return $this->sendResponce(ListOfferResource::collection($offers) ,' success',200);

    }
     /**
 * @group Offer
 */
    public function create(OfferRequest $request) {
        $data=$request->validated();
        $offer=Offer::create($data);
        return $this->sendResponce($offer ,' success',201);

    }
         /**
 * @group Offer
 */
    public function addingProducts(AddProductsRequest $request,$id)
    {
        $data=$request->validated();
        $offer=Offer::findOrFail($id);
      foreach ($data['products_id'] as $products){
        $product= Product::where('id',$products)->first();
        $product->update(['offer_id'=>$id]);
      }
        return $this->sendResponce(null,'success',200);

    }
         /**
 * @group Offer
 */
    public function show($id)
    {
        $offer=Offer::findOrFail($id);
        return $this->sendResponce(OfferShowResource::make($offer),'success',200);
    }
}
