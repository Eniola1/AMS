<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table = 'leaves';
    
    public function employee()
    {
        // return $this->belongsTo(Employee::class, 'emp_id');
    }
}
