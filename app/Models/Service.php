<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    // Define the relationship to Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
       'name', 'category_id',
        // other fillable fields...
    ];

}


