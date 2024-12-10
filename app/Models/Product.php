<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory; 
    protected $fillable = ['name_product', 'description_product','content_product','price_product', 'photo_product', 'categorie_id','category_id'];

    public function category() 
    { 
        return $this->belongsTo(Category::class); 
    } 
 
    public function users() {  
        return $this->belongsToMany(User::class); 
    } 
    public function sales() {  
        return $this->belongsToMany(Sale::class); 
    } 
}
