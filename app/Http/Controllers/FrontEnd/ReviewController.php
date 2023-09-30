<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Rate;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add_rate(Request $r){

        $star_rated = $r->input('product_rating');

        $proudct_id = $r->input('proudct_id');
        


        if(Auth()){
            $userid =  Auth::id();
            
        $userid =  Auth::id();
        $existing_rating = Rate::where('user_id', $userid)->where('prod_id', $proudct_id)->first();

            if($existing_rating){

                $existing_rating->update(['stars_rating' =>$star_rated]);

            }else{
                Rate::create([
                    'user_id' => Auth::id(),
                    'prod_id' => $proudct_id,
                   'stars_rating' => $star_rated,
                        ]);
            
            }
         
            return  redirect()->back();

        }else{
            return ' you must be login';
        }


    }

    public function add($name){

        $proudct = Product::where('name',$name)->where('status',1)->first();

        $data['proudct'] = $proudct;
        return view('FrontEnd.review',$data);
    }

    public function create_review(Request $r){

        $proudct_id = $r->input('proudct_id');
        $proudct = Product::where('id',$proudct_id)->where('status',1)->first();

        if($proudct){
            $user_review = $r->input('user_review');
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' =>$proudct_id,
                'user_review' =>$user_review,
            ]);


        }if($new_review){

            return redirect('proudct/'.$proudct->name);
        }else{

            return 'yddgdhgd';
        }

       

    }

}
