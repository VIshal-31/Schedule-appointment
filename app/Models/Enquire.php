<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
    protected $table = 'Enquire';
    protected $fillable = [ 'name','email','category','service','date','time','message'];
    use HasFactory;
    
}
