<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id')->paginate(10);
        return view('BackEnd.Admin.Category.index', compact('categories'));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = new Category();
        return view('BackEnd.Admin.Category.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',],
            [
                'name.required' => ' اسم القسم مطلوب',
                'name.unique' => 'اسم القسم مستخدم بالفعل',
            ]);
        $category = new Category();
        $category->name = $request->name;  
        $category->status = $request->status;      
        if ($request->hasFile('image')) {
            $image = $request->image;
            $extenation=strtolower($image->extension());
            $fileName = time() . '_' . $extenation;
            $image->move("images/category_image", $fileName);
            $category['image']= $fileName;
        }

        $category->save();
    
        return redirect()->route('Category.Index');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
{
    $category = Category::find($id);
    if (empty($category)) {
        return redirect()->route('Category.Index');
    }
    return view('BackEnd.Admin.Category.Edit', compact('category'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return redirect()->route('Category.Index');
        }
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id . ',id,deleted_at,NULL',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',],
            [
                'name.required' => ' اسم القسم مطلوب',
                'name.unique' => 'اسم القسم مستخدم بالفعل',
            ]);
        
        $category->name = $request->name;  
        $category->status = $request->status; 
        if ($request->hasFile('image')) {
            $image = $request->image;
            $extenation=strtolower($image->extension());
            $fileName = time() . '_' . $extenation;
            $image->move("images/category_image", $fileName);
            $category['image']= $fileName;
        }
        $category->save();

        return redirect()->route('Category.Index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return redirect()->route('Category.Index');
        }
        $category->delete();
        return redirect()->route('Category.Index')->with('success', 'تم حذف القسم بنجاح');
    }   
}
