<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\categories_deatels;
use App\Models\Product;
use App\Models\SubCategory;

class shop_cantroller extends Controller
{
    //

    public function index(Request $request,$categoryslug=null,$subcategoryslug=null,$subid = null){


        $categoryselected = '';
        $categoryselectedsub = '';
        $category = Category::orderBy('id','ASC')->with('subcategories')->where('status',1)->get();
        $proudct = Product::where('status',1);
       if(!empty($categoryslug)){
            $category  = Category::where('name',$categoryslug)->first();
            $proudct  = $proudct->where('category_id',$category->id);
            $categoryselected = $category->id;   
        }
        if(!empty($subcategoryslug)){
           $subcategory  = SubCategory::where('name',$subcategoryslug)->first();
            $proudct  = $proudct->where('idofCategoriesde',$subcategory->id);  
            $categoryselectedsub =  $subcategory->id;
        }

        $proudct  = $proudct->orderBy('id','DESC');
        $proudct  = $proudct->with('proudct_image')->get();
        $data['proudct'] = $proudct;
        $data['category'] = $category;
        $data['categoryselectedsub'] = $categoryselectedsub;
        $data['categoryselected'] = $categoryselected;
        return view('FrontEnd.shop',$data);

    }
}
