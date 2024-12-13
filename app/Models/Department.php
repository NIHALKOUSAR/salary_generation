<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'dept';  // The name of the departments table
    protected $primaryKey = 'id';      // Department ID
    protected $fillable = ['name', 'cid'];  // Assuming these columns exist
    public $timestamps = false; 

    // Define the relationship with College
    public function college(): Belo
    {
        return $this->belongsTo(related: College::class, foreignKey: 'cid');
    }//
}
