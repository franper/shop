<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //creamos este protected con $fillable para guardar datos de forma rapida
    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function products(){
        return $this->hasMany('App\Product');
    }
}
