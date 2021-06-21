<?php

namespace App\Models;

use App\Models\address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class state extends Model
{
    use HasFactory;
    protected $fillable = [
        'state',
        'description',
    ];

    public function addresses(){
        $this->hasMany(address::class);
    }
}
