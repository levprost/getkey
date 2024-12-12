<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['name_sales'];
    public function products() {  
        return $this->belongsToMany(Product::class); 
    }
}
