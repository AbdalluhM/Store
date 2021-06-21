<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'description',
    ];
    public function addresses(){
        $this->hasMany(address::class);
    }
}
