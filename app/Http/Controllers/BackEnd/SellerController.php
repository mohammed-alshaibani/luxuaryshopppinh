<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;


class SellerController extends Controller
{
     /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::orderBy('id')->paginate(5);
        return view('BackEnd.Admin.Seller.Index',compact('sellers'));
    }
    public function index_detail($id)
    {
        $sellers = Seller::find($id);
        $products=Product::all();
        return view('BackEnd.Admin.Seller.SellerDetail',compact('sellers','products'));
    }
    public function index_user()
    {
        $sellers = Seller::orderBy('id')->paginate(5);
        return view('BackEnd.User.Seller.Index',compact('sellers'));
    }
    public function index_detail_user($id)
    {
        $sellers = Seller::find($id);
        $products=Product::all();
        return view('BackEnd.User.Seller.SellerDetail',compact('sellers','products'));
    }
      /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BackEnd.Admin.Seller.Create');
    }

     /**
     * Store a newly created Seller in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $sellers = new Seller();
        $sellers->name = $request->name;
        $sellers->phone = $request->phone;
        $sellers->address = $request->address;
        $sellers->note = $request->note;
        $sellers->save();

        return redirect()->route('Seller.Index')
            ->with('success', 'تم إضافة تاجر بنجاح');
    }
     /**
     * Show the form for editing the specified .
     *
     * @param  \App\Models\Seller  $sellers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $sellers = Seller::find($id);
        return view('BackEnd.Admin.Seller.Edit', compact('sellers'));
    }

    
    /**
     * Update the specified coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $sellers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $sellers = Seller::find($id);
        if (empty($sellers)) {
            return redirect()->route('Seller.Index')->with('error', 'العنصر غير موجود');
        }
        $sellers->name = $request->name;
        $sellers->phone = $request->phone;
        $sellers->address = $request->address;
        $sellers->note = $request->note;
        $sellers->save();

        return redirect()->route('Seller.Index')
            ->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  \App\Models\Seller  $sellers
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(Request $request, $id)
    {
        $sellers = Seller::find($id);
        if (empty($sellers)) {
            return redirect()->route('Seller.Index');
        }
        $sellers->delete();
        return redirect()->route('Seller.Index')->with('success', 'تم الحذف بنجاح');
    }



}

