<?php

namespace App\Services\Subcategory;




class GetSubcategory
{
    public function getcategory ($query,$search,$sort){

        if($search){
            $query->where('name', 'like', '%' . $search . '%');
        }
        if($sort){
            $query->orderBy('name', $sort);
        }
        return $query;
    }
}
