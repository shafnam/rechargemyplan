<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //Table Name
    protected $table = 'carts';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timeStamps = true;
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
 
    public function cart_items()
    {
        return $this->hasMany('App\CartItem');
    }
}
