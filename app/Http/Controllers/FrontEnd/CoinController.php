<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coin;
use App\Models\Order;
use App\Models\OrderDetail;

class CoinController extends Controller
{
    public function edit(Request $request, $id)
    {
        $coin = Coin::find($id);
        return view('BackEnd.Admin.Coin.Edit', compact('coin'));
    }
    
    public function update_coin(Request $r)
{
    $query = Coin::where('id', $r->id)->update([
        'name' => $r->name,
        'value' => $r->value,
    ],
    [
        'name.unique' => 'إسم العملة موجود مسبقا',
    ]);
        return redirect('dashboard/Coin/');
}
    public function create(){
        return view('BackEnd.Admin.Coin.Create');
    }
    public function add_coin(Request $r)
    {
        $data = $r->validate([
            'value' => 'required',
            'name' => 'required|unique:coins',
        ],
        [
            'name.unique' => 'إسم العملة موجود مسبقا',
        ]);
    
        Coin::create($data);
        return redirect('dashboard/Coin/');
    }
    public function coins($id){
        $coin_edit = Coin::where('id',$id)->get();
        $data['ce'] = $coin_edit;
        return view('coins_edite',$data);
    }

    public function coin(){
        $coin = Coin::all();
        $data['c'] = $coin;
        return view('BackEnd.Admin.Coin.Index',$data);
    }
    public function destroy(Request $request, $id)
    {
        $coin = Coin::find($id);
        $coin->delete();
        return redirect()->route('coin.index')->with('success', 'تم الحذف بنجاح');
    }
   
}
