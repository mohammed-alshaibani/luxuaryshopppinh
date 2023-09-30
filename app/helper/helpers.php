<?php
use App\Models\Category;
use Jenssegers\Agent\Agent;

function index()
{
    $agent = new Agent();
    $isMobile = $agent->isMobile();
    
    $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
    
    if ($isMobile) {
        return $categories;
    } else {
        return $categories->take(8);
    }
}

?>
