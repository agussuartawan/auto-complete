<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	public $table = "Products";
    protected $guarded = ["id"];
}
