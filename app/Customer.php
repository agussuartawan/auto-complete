<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
