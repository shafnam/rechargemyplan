<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //Table Name
    protected $table = 'plans';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timeStamps = true;
    
    public function carriers()
    {
        return $this->belongsTo('App\Carrier','carrier_id');
    }

    public function cart_items()
    {
        return $this->hasMany('App\CartItem', 'item_id');
    }
}
