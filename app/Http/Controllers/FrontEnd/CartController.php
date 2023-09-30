<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
class CartController extends Controller
{
      

public function index()  // get all data from database
{
    $products = Product::all();
    return view('FrontEnd.product', compact('products'));  //  show all data in page of products.blade.php
}

// this function is to show cart of product because we wanna show result of choose product by user in this page
public function cart()  
{
    return view('FrontEnd.cart');  
}



public function addToCart($id) // by this function we add product of choose in card
{
    $p = Images::where('product_id',$id)->first();
    $product = Product::find($id);
    if(!$product) {
        abort(404);
    }
// what is Session:
//Sessions are used to store information about the user across the requests.
// Laravel provides various drivers like file, cookie, apc, array, Memcached, Redis, and database to handle session data. 
// so cause write the below code in controller and tis code is fix
    $cart = session()->get('cart');  

    // if cart is empty then this the first product
    if(!$cart) {

        $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->original_price,
                    "image" => $p->image,
                    "idproudct" => $product->id,
                ]
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'added to cart successfully!');
    }

    // if cart not empty then check if this product exist then increment quantity
    if(isset($cart[$id])) {

        $cart[$id]['quantity']++;

        session()->put('cart', $cart); // this code put product of choose in cart

        return redirect()->back()->with('success', 'تم إضافة المنتج بنجاح!');

    }

    // if item not exist in cart then add to cart with quantity = 1
    $cart[$id] = [
        "name" => $product->name,
        "quantity" => 1,
        "price" => $product->original_price,
        "idproudct" => $product->id,
        "image" => $p->image,
        
    ];

    session()->put('cart', $cart); // this code put product of choose in cart

    return redirect()->back()->with('success', 'تمت إضافة المنتج لسلة ');
}

// update product of choose in cart
public function update(Request $request)
{
    if($request->id and $request->quantity)
    {
        $cart = session()->get('cart');

        $cart[$request->id]["quantity"] = $request->quantity;

        session()->put('cart', $cart);

        session()->flash('success', 'تم إضافة المنتج إلى السلة ');
    }
}

// delete or remove product of choose in cart
public function remove(Request $request)
{
    if($request->id) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'تم حذف المنتج من السلة ');
    }
}}