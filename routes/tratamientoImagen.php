<?php

//0  saber si un usuario o producto tiene o no imagen
$user = App\User::find(1); 
    $image = $user->image;

    if($image){
        echo('hay una imagen');
    }else{
        echo('no hay imagen');
    }

    return $image;


//01 crear una imagen para el usuario con el metodo save()
$imagen = new Image(['url'=>'imagenes/avatar04.png']);

$user = App\User::find(1); 
$user->image()->save($imagen);

return $user;

//02 obtener las informaciones de las imagenes atraves del usuario
$user = App\User::find(1); 

return $user->image->url;

//03 crear varias imagenes para el producto con el metodo saveMany()

$producto = Product::find(1); 
$producto->images()->saveMany([
    new Image(['url'=>'imagenes/avatar.png']),
    new Image(['url'=>'imagenes/avatar1.png']),
    new Image(['url'=>'imagenes/avatar2.png'])
]);

return $producto;

//04 crear una imagen para el usuario con el metodo create()

$user = App\User::find(1); 
$user->image()->create([
    'url'=>'imagenes/avatar5.png'
]);

return $user;

//05 crear varias imagenes para el producto con el metodo crateMany()  
$imagenes = [];
$imagenes[]['url'] = 'imagenes/avatar.png';
$imagenes[]['url'] = 'imagenes/avatar2.png';
$imagenes[]['url'] = 'imagenes/avatar5.png';

$producto = Product::find(3); 
$producto->images()->createMany($imagenes);

return $producto->images;

//06 actualizar una imagen para el usuario con el metodo push()
$user = App\User::find(1); 
$user->image->url='imagenes/avatar2.png';
$user->push();

return $user->image;

//07 actualizar una imagen para el producto con el metodo push()
$producto = Product::find(1); 
$producto->images[0]->url='imagenes/avatar.png';
$producto->push();

return $producto->images;

//08 buscar el registro relacinado con la imagen
$image = Image::find(1); 

return $image->imageable;

//09 Delimitar los registros
$producto = Product::find(2); 
return $producto->images()->where('url','imagenes/avatar.png')->get();

//10 ordenar registros que provienen de la relacion
$producto = Product::find(2); 
return $producto->images()->where('url','imagenes/avatar.png')->orderBy('id','desc')->get();

//11 contar los registros relacionados
$user = App\User::withCount('image')->get();
$user = $user->find(1); 

return $user;

//12 contar los registros relacionados con productos
$prod = App\Product::withCount('images')->get();
$prod = $prod->find(2); 

return $prod->images_count;

//13 contar los registros relacionados con productos de otra forma
$prod = App\Product::find(2);
return $prod->loadCount('images');

//14 lazyloading carga diferida
$prod = Product::find(1);
$image = $prod->image;
$category = $prod->category;

//15 carga previa eager loading
$prod = Product::with('images')->get();
return $prod;

//17 carga previa de multiples relaciones
$prod = Product::with('images','category')->get();
return $prod;

//18 carga previa de multiples relaciones de un producto especifico
$prod = Product::with('images','category')->find(2);
return $prod;

//20 eliminar una imagen
$prod = Product::find(1);
$prod->images[0]->delete();
return $prod;

//21 eliminar todas las imagenes
$prod = Product::find(1);
$prod->images()->delete();
return $prod;
