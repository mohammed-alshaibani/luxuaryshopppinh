<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paying;


class PayingController extends Controller
{
     /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pay = Paying::orderBy('id')->paginate(5);
        return view('BackEnd.Admin.Paying.Index',compact('pay'));
    }

    public function create()
    {
        return view('BackEnd.Admin.Paying.Create');
    }
    
     public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'account_number'=>'required',
                'logo'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $pay = new Paying();
            $pay->name = $request->name;
            $pay->account_number = $request->account_number;
            if ($request->hasFile('logo')) {
                $logo = $request->logo;
                $extenation=strtolower($logo->extension());
                $fileName = time() . '_' . $extenation;
                $logo->move("images/bank_logo", $fileName);
                $pay['logo']= $fileName;
            }
            $pay->save(); 
            return redirect()->route('Paying.Index');
        }

        
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paying  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $pay = Paying::find($id);
        return view('BackEnd.Admin.Paying.Edit', compact('pay'));
    }
    
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Paying  $pay
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required',
                'account_number' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            $pay = Paying::find($id);
            if (empty($pay)) {
                return redirect()->route('Paying.Index')->with('error', 'العنصر غير موجود');
            }
        
            $pay->name = $request->name;
            $pay->account_number = $request->account_number;
        
            if ($request->hasFile('logo')) {
                $logo = $request->logo;
                $extenation=strtolower($logo->extension());
                $fileName = time() . '_' . $extenation;
                $logo->move("/images/bank_logo", $fileName);
                $pay['logo']= $fileName;
            }
        
            $pay->save();
            return redirect()->route('Paying.Index')->with('success', 'تم التحديث بنجاح');
        }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paying  $pay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $pay = Paying::find($id);
        if (empty($pay)) {
            return redirect()->route('Paying.Index');
        }
        $pay->delete();
        return redirect()->route('Paying.Index')->with('success', 'تم الحذف بنجاح');
    }
    public function payment()
    {
        $sho_payment = Paying::all();
        return view('FrontEnd.checkpage', compact('sho_payment'));
    }
    
}

