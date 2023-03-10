<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'schedule_employees', 'schedule_id', 'emp_id');
    }
}
