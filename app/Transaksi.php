<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public $table = "transaksi";
    protected $guarded = ["id"];

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
