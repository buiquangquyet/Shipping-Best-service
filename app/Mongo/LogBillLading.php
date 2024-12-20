<?php

namespace App\Mongo;
use App\Enums\LogType;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class LogBillLading extends Moloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'log_bill_lading';
    public $timestamps = false;

}
