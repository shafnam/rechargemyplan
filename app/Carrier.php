<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    //Table Name
    protected $table = 'carriers';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timeStamps = true;

    public function plans()
    {
        return $this->hasMany('App\Plan','carrier_id');
    }

    public function getCarriersForDD(){
        
        /*$category_id = \App\Category::where('slug',$category_slug)->pluck('id');
        $carriers = \App\Brand::where('category_id',$category_id)->pluck('name', 'name');
        $carriers->prepend('Select...', "");

        return $carriers;*/

    }
}
