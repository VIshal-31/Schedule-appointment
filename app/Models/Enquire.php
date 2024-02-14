<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
    protected $table = 'Enquire';
    protected $fillable = [ 'name','email','contact','category','service','service_name','date','time','message','status','service_start_time', 'service_end_time'];
    use HasFactory;
    
}
