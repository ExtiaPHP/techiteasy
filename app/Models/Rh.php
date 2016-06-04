<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rh extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rh';
    public $timestamps = false;
    protected $appends = array('name');

    public function getNameAttribute()
    {
        return $this->attributes['lastname'].' '.$this->attributes['firstname'];
    }


}
