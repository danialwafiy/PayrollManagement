<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $guarded = [];

    public function salary()
    {
        return $this->belongsTo('App\Salary','salary_id','id');
    }
}
