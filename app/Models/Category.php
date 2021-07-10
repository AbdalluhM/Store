<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['category_name','category_image','description','parent_id'];

    protected $appends=['category_image_path'];
    public function parent(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function childrens(){
        return $this->belongsTo(Category::class,'parent_id');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function sliders(){
        return $this->hasMany(Slider::class);
    }

    public function getCategoryImagePathAttribute()
    {
        return asset('storage/images/categories/'.($this->category_image));
    }
}
