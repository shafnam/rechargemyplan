<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    //Table Name
    protected $table = 'invoice_items';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timeStamps = true;

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
 
    // public function plans()
    // {
    //     return $this->belongsTo('App\Plan','item_id');
    // }
}
