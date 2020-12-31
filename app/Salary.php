<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function allowance()
    {
        return $this->hasMany('App\Allowance','salary_id','id');
    }

    public function deduction()
    {
        return $this->hasMany('App\Deduction','salary_id','id');
    }
}
