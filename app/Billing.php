<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    //
    
    protected $fillable = ['description','status','value','package'];
  
    protected $table = 'billing';
}
