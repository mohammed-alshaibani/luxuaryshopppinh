<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 5); // Number of items per page

        $banners = Banner::with('product')->where('status', true)->paginate($perPage);

        return response()->json(['banners' => $banners]);
    }
}
