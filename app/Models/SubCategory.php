<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Ini boleh letak nama apa2 just untuk relationship
    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }
}
