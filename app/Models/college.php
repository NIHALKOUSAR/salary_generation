<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class college extends Model
{
    protected $table = 'college';   
    protected $primaryKey = 'id';  
    protected $fillable = ['name'];  
    public $timestamps = false; 
    public function departments()
    {
        return $this->hasMany(Department::class, 'cid');
    }
}

