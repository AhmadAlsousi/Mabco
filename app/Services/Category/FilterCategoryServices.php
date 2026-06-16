<?php

namespace App\Services\Category;

use App\Models\Category;


class FilterCategoryServices
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