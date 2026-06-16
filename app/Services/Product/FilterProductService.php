<?php

namespace App\Services\Product;


class FilterProductService
{



 public function get_products($query, $search ,$tag ,$min_price,$max_price,$sort){


if($search){
    $query->where('name', 'like', '%' . $search . '%');
}
// dd($tag);
if($tag){
    $query->whereHas('subcategory', function ($query) use ($tag) {
        $query->where('name',$tag);
    });
}
if($min_price )
{
    // dd($min_price);
     $query->where('price','>=',$min_price);
// dd($query);
     }
     if($max_price )
{
     $query->where('price','<=',$max_price);
// dd($query);
     }
         if($sort){
            $query->orderBy('name', $sort);
        }
return $query;

}
}
