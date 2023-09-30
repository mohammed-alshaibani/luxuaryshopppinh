<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Rate;
use App\Models\Images;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();
        $images = Images::all();
        return view('BackEnd.Admin.Product.Index', compact('products','categories','images'));
    }

    public function index_service()
    {
        $products = Product::paginate(15);
        $categories = Category::all();
        $images = Images::all();
        return view('BackEnd.User.Product.Index', compact('products','categories','images'));
    }
    public function showall(){
        $proudcts = Product::where('featured',1)->where('status',1)->with('images')->get(); 
        $data['featured'] = $proudcts;
        $latestproudct = Product::where('latest',1)->where('status',1)->with('images')->get();
        $data['latest'] = $latestproudct;
        $trendproudct = Product::orderBy('id','DESC')->where('trend','>',20)->with('images')->get();
        $data['trend'] = $trendproudct;
        $result1 = DB::table('products')
        ->join('banners','products.id','=','banners.product_id')
        ->select('products.name','products.description','products.id','banners.image')->get();
        $result = DB::table('products')
        ->join('banners','products.id','=','banners.product_id')
        ->select('products.name','products.description','products.id','banners.image')->where('banners.status',1)->get();
        $data['result1'] = $result1;
        $data['result'] = $result;
        return view('FrontEnd.home',$data);
    }
    public function indexhome(){
        $proudcts = Product::where('featured',1)->where('status',1)->get();
        $data['featured'] = $proudcts;
        $latestproudct = Product::orderBy('latest',1)->where('status',1)->take(8)->get();
        $data['latest'] = $latestproudct;
        $result1 = DB::table('proudct')
        ->join('banners','proudct.id','=','banners.proudct_id')
        ->select('proudct.name','proudct.description','proudct.id','banners.image')->get();
        $result = DB::table('proudct')
        ->join('banners','proudct.id','=','banners.proudct_id')
        ->select('proudct.name','proudct.description','proudct.id','banners.image')->where('banners.status',1)->get();
        $data['result1'] = $result1;
        $data['result'] = $result;
        return view('FrontEnd.home',$data);
    }

    public function indexhomeapi(Request $request)
    {
    $products = Product::where('featured', 1)->where('status', 1)->get();
    $featured = $products->toArray();
    $latestProducts = Product::orderBy('id', 'DESC')->where('status', 1)->take(8)->get();
    $latest = $latestProducts->toArray();

    $data = [
        'featured' => $featured,
        'latest' => $latest,
    ];

    if ($request->wantsJson()) {
        return response()->json($data);
    }

    return view('FrontEnd.home', $data);
}

    public function show()
    {
        $products = Product::all();
        $images = Images::all();
        $categories = Category::all();
        $featuredProducts = Product::where('featured', true)->get();
        $statusProducts = Product::where('status', true)->get();
        return view('Customer.Pages.Index', compact('products', 'images','categories','featuredProducts','statusProducts'));
    }
    public function proudctdetail($id)
    {
        // Retrieve the product from the database based on the ID
        $product = Product::findOrFail($id);
        $images = Images::all();
        // Pass the product to the view
        return view('Customer.Product.ProductDetail', compact('product','images'));
    }

    public function create()
    {
    $categories = Category::all(); // Replace `Category` with your actual model name for categories
    $subcategories = SubCategory::all(); 
    $sellers = Seller::all(); 
    $product = new Product();
    return view('BackEnd.Admin.Product.Create', compact('categories','subcategories','sellers','product'));
      }
 
    public function store(Request $request)
     {
      $request->validate([
        'tag' => 'nullable|string',
        'name' => 'required|string',
        'seller_price' => 'required|numeric',
        'original_price' => 'required|numeric',
        'different_price' => 'nullable|numeric',
        'discounted_price' => 'nullable|numeric',
        'description' => 'required|string',
        'quantity' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'subcategory_id' => 'required|exists:subcategories,id',
        'seller_id' => 'nullable|exists:sellers,id',
        'status' => 'nullable|boolean',
        'featured' => 'nullable|boolean',
        'trend' => 'nullable|boolean',
        'latest' => 'nullable|boolean',
    ],
    [
        'name.required' => 'أضف إسم المنتج',
        'description.required' => 'أضف وصف المنتج',
        'quantity.required' => 'أضف عدد المنتجات',
        'seller_price.required' => 'أضف سعر التكلفة',
        'original_price.required' => 'أضف سعر البيع',
        'category_id.required' => 'حدد القسم الرئيسي ',
        'subcategory_id.required' => 'حدد القسم الفرعي',
    ]);
    $product = new Product();
    $product->tag = $request->tag;
    $product->name = $request->name;
    $product->seller_price = $request->seller_price;
    $product->original_price = $request->original_price;
    $product->different_price = $request->different_price;
    $product->discounted_price = $request->discounted_price;
    $product->description = $request->description;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;
    $product->subcategory_id = $request->subcategory_id;
    $product->seller_id = $request->seller_id;
    $product->status = $request->status;
    $product->featured = $request->featured;
    $product->trend = $request->trend;
    $product->latest = $request->latest;
    $product->save();

    if ($request->hasFile('image')) {
      $uploadFolder = 'images/products_image';

    foreach ($request->file('image') as $file) {
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move($uploadFolder, $imageName);

        $image = new Images([
            'product_id' => $product->id,
            'image' => $imageName,
        ]);
        $image->save(); // Save the image to the database
    }
}
    return redirect()->route('Product.Index');}


    public function edit(Request $request, $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all(); 
        $sellers = Seller::all(); 
        return view('BackEnd.Admin.Product.Edit', compact('product','categories','subcategories','sellers'));
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'tag' => 'nullable|string',
            'name' => 'required|string',
            'seller_price' => 'required|numeric',
            'original_price' => 'required|numeric',
            'different_price' => 'nullable|numeric',
            'discounted_price' => 'nullable|numeric',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'seller_id' => 'nullable|exists:sellers,id',
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'trend' => 'nullable|boolean',
            'latest' => 'nullable|boolean',
        ],
        [
            'name.required' => 'أضف إسم المنتج',
            'description.required' => 'أضف وصف المنتج',
            'quantity.required' => 'أضف عدد المنتجات',
            'seller_price.required' => 'أضف سعر التكلفة',
            'original_price.required' => 'أضف سعر البيع',
            'category_id.required' => 'حدد القسم الرئيسي ',
            'subcategory_id.required' => 'حدد القسم الفرعي',
        ]);
        $product = Product::find($id);
        if (empty($product)) {
            return redirect()->route('Product.Index')->with('error', 'العنصر غير موجود');
        }

    $product->tag = $request->tag;
    $product->name = $request->name;
    $product->seller_price = $request->seller_price;
    $product->original_price = $request->original_price;
    $product->different_price = $request->different_price;
    $product->discounted_price = $request->discounted_price;
    $product->description = $request->description;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id;
    $product->subcategory_id = $request->subcategory_id;
    $product->seller_id = $request->seller_id;
    $product->status = $request->status;
    $product->featured = $request->featured;
    $product->latest = $request->latest;
        
        if ($request->hasFile('image')) {
            $images = [];
    
            foreach ($request->file('image') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $images[] = $imageName;
                $extenation = strtolower($file->extension());
                $fileName = time() . '_' . $extenation;
                $file->move("images/products_image", $fileName);
                $images[] = $fileName;
            }
    
            $product->image = json_encode($images);
        }

        $product->save();
        return redirect()->route('Product.Index');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return redirect()->route('Product.Index');
        }
        $product->delete();
        return redirect()->route('Product.Index')->with('success', 'تم الحذف بنجاح');
    }

    public function getSubcategories(Request $request, $categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
  

    public function all()
    {
    $products = Product::all();
    return view('Customer.Pages.Search', compact('products'));
     }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $searchInput = $request->searchInput; // Corrected the variable name
            $data = Product::where('tag', 'like', "%{$searchInput}%")
                          ->orderBy("id", "ASC") // Corrected "orderby" to "orderBy"
                          ->get();  // Added "get()" to retrieve the results
                          return view('BackEnd.Admin.Product.search_page', ['products' => $data]);
            }
    }
    public function proudct($name){
 
        $proudct = Product::where('name',$name)->with('images')->first();
        $rel = Product::where('subcategory_id',$proudct->subcategory_id)->with('images')->get();
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
        return view('FrontEnd.proudct',$data);
      }

      /**Search In User dashboard */
      public function search_user(Request $request)
      {
          if ($request->ajax()) {
              $searchInput = $request->searchInput; // Corrected the variable name
              $data = Product::where('tag', 'like', "%{$searchInput}%")
                            ->orderBy("id", "ASC") // Corrected "orderby" to "orderBy"
                            ->get();  // Added "get()" to retrieve the results
                            return view('BackEnd.User.Product.search_page', ['products' => $data]);
              }
      }
}
