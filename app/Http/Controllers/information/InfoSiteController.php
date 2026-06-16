<?php

namespace App\Http\Controllers\information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Carbon\Carbon;
class InfoSiteController extends APIController
{
    public function getInfo()
    {

        $productsCount = \App\Models\Product::count();
       $minCountProduct = \App\Models\Product::min('price');
       $maxCountProduct = \App\Models\Product::max('price');

        $categoriesCount = \App\Models\Category::count();
        $subcategoriesCount = \App\Models\Subcategory::count();
        $resentlyadded = \App\Models\Product::where(
    'created_at',
    '>=',
    Carbon::now()->subDay()
)->count();
        $info=[
            'productsCount'=>$productsCount,
            'categoriesCount'=>$categoriesCount,
            'subcategoriesCount'=>$subcategoriesCount,
            'resentlyadded'=>$resentlyadded,
            'minCountProduct'=>$minCountProduct,
            'maxCountProduct'=>$maxCountProduct
        ];
        return $this->sendResponce($info, 'success', 200);
        // return 0;
    }
}
