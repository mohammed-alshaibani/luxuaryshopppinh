<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class BannerController extends Controller
{
    
    public function index()
     {
         $banners = Banner::paginate(5);

         return view('BackEnd.Admin.Banner.Index', compact('banners'));
     }
 
  public function create()
    {
     $products = Product::all(); 
     return view('BackEnd.Admin.Banner.Create', compact('products'));
    }
 
           public function store(Request $request)
           {
               $request->validate([
                   'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                   'product_id' => 'required',
                   'status' => 'required',
               ]);
           
               $banner = new Banner();
           
               if ($request->hasFile('image')) {
                   $image = $request->image;
                   $extension = strtolower($image->extension());
                   $fileName = time() . '_' . $extension;
                   $image->move("images/banner_image", $fileName);
                   $banner->image = $fileName;
               }
           
               $banner->product_id = $request->product_id;
               $banner->status = $request->status;
               $banner->save();
           
               return redirect()->route('Banner.Index')->with('success', 'Banner created successfully.');
           }
 
           public function edit($id)
           {
               $banner = Banner::find($id);
               $products = Product::all();
               return view('BackEnd.Admin.Banner.Edit', compact('banner', 'products'));
           }
           
           public function update(Request $request, $id)
           {
               $request->validate([
                   'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                   'product_id' => 'required',
               ]);
           
               $banner = Banner::find($id);
               if (!$banner) {
                   return redirect()->back()->with('error', 'Banner not found.');
               }
           
               if ($request->hasFile('image')) {
                   $image = $request->image;
                   $extension = strtolower($image->extension());
                   $fileName = time() . '_' . $extension;
                   $image->move("images/banner_image", $fileName);
                   $banner->image = $fileName;
               }
           
               $product = Product::find($request->product_id);
               if (!$product) {
                   return redirect()->back()->with('error', 'لا يوجد منتج للعروض');
               }
           
               $banner->product_id = $product->id;
               $banner->save();
           
               return redirect()->route('Banner.Index')->with('success', 'نجاح نشر الإعلان');
           }
 
     public function destroy(Request $request, $id)
     {
         $banner = Banner::find($id);
         $banner->delete();
         return redirect()->route('Banner.Index')->with('success', 'تم الحذف بنجاح');
     }
}


