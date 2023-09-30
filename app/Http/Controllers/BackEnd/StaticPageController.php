<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaticPage;


class StaticPageController extends Controller
{
    public function index()
    {
        $staticPages = StaticPage::all();

        return view('BackEnd.Admin.StaticPage.Index', compact('staticPages'));
    }
    /*
    public function create()
    {
        return view('BackEnd.Admin.StaticPage.Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|in:about,privacy,contact_us,privacy_return',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $data['update_date'] = now(); // Set the current timestamp as the update_date

        StaticPage::create($data);

        return redirect()->route('static_pages.index')->with('success', 'Static page created successfully');
    }*/

    public function edit($id)
    {
        $staticPage = StaticPage::findOrFail($id);

        return view('BackEnd.Admin.StaticPage.Edit', compact('staticPage'));
    }

    public function update(Request $request, $id)
    {
        $staticPage = StaticPage::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|in:about,privacy,contact_us,privacy_return|unique:static_pages,name,' . $staticPage->id,
            'title' => 'required|string',
            'content' => 'required|string',],
            [
                'name.unique' => ' اسم الصفحة موجود بالفعل',
            ]);
        $data['update_date'] = now(); // Set the current timestamp as the update_date
        $staticPage->update($data);

        return redirect()->route('static_pages.index')->with('success', 'Static page updated successfully');
    }
    
    public function about(){
        $about =   StaticPage::where('name','about')->get();
        $data['about'] = $about;
        return view('FrontEnd.about_us',$data);

     }
     public function privacy(){
         $about =  StaticPage::where('name','privacy')->get();
         $data['privacy'] = $about;
         return view('FrontEnd.privacy',$data);
      }
 
      public function privacy_return(){
         $about =   StaticPage::where('name','privacy_return')->get();
         $data['privacy_return'] = $about;
         return view('FrontEnd.privacy_return',$data);
      }
 
      public function concat_us(){ 
         $about =  StaticPage::where('name','contact_us')->get();
         $data['concat_us'] = $about;
         return view('FrontEnd.concat_us',$data);
      }
}
