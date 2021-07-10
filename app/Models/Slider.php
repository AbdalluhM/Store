<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;


    protected $fillable = ['image','category_id','description'];
    protected $appends = ['slider_image_path'];
    public $timestamps = false;



    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function getSliderImagePathAttribute()
    {
        return asset('storage/images/sliders/' . ($this->image));
    }
}
