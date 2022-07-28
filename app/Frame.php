<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    /**
     * Has Many cells
     */
    public function cells()
    {
        return $this->hasMany('App\Cell');
    }

}
