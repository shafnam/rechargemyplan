<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['title', 'price', 'payment_status'];

    public function getPaidAttribute() {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
	}
	
	public function user()
    {
        return $this->belongsTo('App\User');
    }
 
    public function invoice_items()
    {
        return $this->hasMany('App\InvoiceItem');
    }
}
