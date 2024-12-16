<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory; 
    protected $fillable = ['name_product', 'description_product','content_product','price_product','image_product', 'photo_product','category_id'];

    public static function getCurrentCampaign()
    {
        $month = now()->month;
        if ($month >= 6 && $month <= 8) {
        return 'Summer Sales';
        } elseif ($month >= 11 || $month <= 1) {
        return 'Winter Sales';
        } else {
        return 'Regular Sales';
        }
    }
    
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
