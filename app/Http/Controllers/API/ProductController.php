<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        /*
        $cat = new Product();
        $cat->nombre        = 'Mujer';
        $cat->slug          = 'mujer';    
        $cat->description   = 'Ropa de Mujer';
        $cat->save();
        return $cat;
        */
    
        return Product::all();
    }

    public function show($slug)
    {
        if(Product::where('slug',$slug)->first()){
            return ('Slug ya existe');
        }else{
            return ('Slug Disponible');
        }
        
    }
}
