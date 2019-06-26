<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    //Table Name
    protected $table = 'contact_emails';
    //Primary Key
    public $primaryKey = 'id';
    //TimeStamps
    public $timeStamps = true;
}
