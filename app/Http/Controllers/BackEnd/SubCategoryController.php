<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
   
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(10);
        $categories = Category::all();
        return view('BackEnd.Admin.Subcategory.Index', compact('subcategories','categories'));
    }
    public function show()
     {
    $subcategories = Subcategory::with('category')->paginate(10);
    $categories = Category::all();
    return view('layouts.Customer.header', compact('categories', 'subcategories'));
        }


    public function create()
    {
        $categories = Category::all();
        return view('BackEnd.Admin.Subcategory.Create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|integer',],
            [
                'name.required' => ' اسم القسم الفرعي مطلوب',
                'category_id.required' => ' اسم القسم الرئيسي مطلوب',
            ]);
    
        $subcategory = new Subcategory();
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect()->route('Subcategory.Index')->with('success', 'تم إضافة القسم الفرعي بنجاح');
    }

    
    public function edit(Request $request, $id)
    {
        $subcategories = Subcategory::find($id);
        $categories = Category::all();
        return view('BackEnd.Admin.Subcategory.Edit', compact('subcategories','categories'));
    }

     public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required|integer',],
            [
                'name.required' => ' اسم القسم الفرعي مطلوب',
                'category_id.required' => ' اسم القسم الرئيسي مطلوب',
            ]);
            $subcategory = Subcategory::find($id);
            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;
            $subcategory->update($request->all());
            return redirect()->route('Subcategory.Index')->with('success', 'تم تحديث القسم الفرعي بنجاح');
      }

    public function destroy(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);
        if (empty($subcategory)) {
            return redirect()->route('Subcategory.Index');
        }
        $subcategory->delete();
        return redirect()->route('Subcategory.Index')->with('success', 'تم حذف القسم الفرعي بنجاح');
    }
    public function MainPage(){
        return view('BackEnd.User.Header');
    }

}
