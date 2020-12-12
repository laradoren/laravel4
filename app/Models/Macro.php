<?php

namespace App\Models;
use App\Models\Page;

class Macro {
    public function command_img($img_path, $alt) {
				$path = asset('storage/' . $img_path);
				$result = '<img src="'. $path .'" alt="'. $alt .'" />';
				return $result;
    }

    public function command_page_link($code, $text, $css_class) {

				$result = '<a href="'.  $code .'" class="'. $css_class .'">'. $text .'<a>';
				return $result;
    }

    public function command_get_tiles($category_code, $order) {
				$main_page = Page::where('code', $category_code)->first();      
				$main_page->orderType = $order;       
				$tiles = [];        
				foreach ($main_page->children as $page) { 
						if ($page->code != "root") {                
								array_push($tiles, $page->renderTile());
						} 
				}        
				return implode($tiles);
    }
}