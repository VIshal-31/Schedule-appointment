<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [ 'name','email','category','service','date','time','message'];
    use HasFactory;
    
}
