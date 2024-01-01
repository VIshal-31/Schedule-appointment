<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Add 'name' field to the fillable array

    // Define the relationship to Service model
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}

