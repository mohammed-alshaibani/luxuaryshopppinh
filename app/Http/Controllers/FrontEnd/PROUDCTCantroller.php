<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Images;
use App\Models\Review;
use App\Models\banners;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PROUDCTCantroller extends Controller
{
    

    public function index(){

        $proudcts = Product::where('featured','yes')->where('status',1)->with('images')->get();
        $data['featured'] = $proudcts;
        $latestproudct = Product::orderBy('id','DESC')->where('status',1)->with('images')->get();
        $data['latest'] = $latestproudct;
        $result1 = DB::table('products')
        ->join('banners','products.id','=','banners.proudct_id')
        ->select('products.name','products.description','products.id','banners.image')->get();
        $result = DB::table('products')
        ->join('banners','products.id','=','banners.proudct_id')
        ->select('products.name','products.description','products.id','banners.image')->where('banners.status',1)->get();
        $data['result1'] = $result1;
        $data['result'] = $result;
        return view('home',$data);

    }


    public function banner(){

        $result = DB::table('proudct')
        ->join('banners','proudct.id','=','banners.proudct_id')
        ->select('proudct.name','banners.image')->get();
        return $result;
        
    }

    public function proudct($name){
 
        $proudct = Product::where('name',$name)->with('proudct_image')->first();
         $rel = Product::where('idofCategoriesde',$proudct->idofCategoriesde)->get();

        $rating = Rate::where('prod_id',$proudct->id)->get();
        $rating_sum = Rate::where('prod_id',$proudct->id)->sum('stars_rating');
        $review = Review::where('prod_id',$proudct->id)->get();
         $data = [];


         if($rating->count() > 0){
            $rating_value = $rating_sum / $rating->count();


         }else{
          
            $rating_value = 0;
            
         }
         $data['rating_value'] = $rating_value;
         $data['rating'] = $rating;
         $data['review'] = $review;
         $data['rel'] = $rel;
        $data['proudct'] = $proudct;
        return view('proudct',$data);
  
  
      }

      public function store(Request $request)
      {
          $student = new Product();
          $student->name = $request->input('name');
          $student->image_src = $request->input('image');
          $student->description = $request->input('description');
          $student->idofCategoriesde = $request->input('idofcategory');
          $student->category_id = $request->input('cstgotyid');
          $student->status = $request->input('status');
          $student->featured = $request->input('featuerd');
          $student->price = $request->input('price');
          $student->old_price = $request->input('old_price');          
          $student->quantity = $request->input('quantity');          
          if($request->hasfile('image'))
          {
              $file = $request->file('image');
              $extenstion = $file->getClientOriginalExtension();
              $filename = time() .'.' .$extenstion;
              $file->move('uploads/students/', $filename);
              $student->image_src = $filename;
              
          }
  
         $student->save();
          return 'succssed';
      }

}
